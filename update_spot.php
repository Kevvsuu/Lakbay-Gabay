<?php
// Start output buffering to catch any unwanted output
ob_start();

// Completely disable error display to prevent HTML output
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);

// Set JSON header immediately
header('Content-Type: application/json; charset=UTF-8');

// Set UTF-8 encoding
mb_internal_encoding('UTF-8');
mb_http_output('UTF-8');

// Database connection
$servername = "sql103.infinityfree.com";
$username = "if0_39925056";
$password = "CAQpbXykjVsU";
$dbname = "if0_39925056_tourismmap";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    ob_end_clean();
    die(json_encode(["success" => false, "message" => "Database connection failed"]));
}

// Set UTF-8 character set for database connection
$conn->set_charset("utf8mb4");

// Helper function to send JSON response
function sendResponse($success, $message) {
    ob_end_clean(); // Clear any buffered output
    echo json_encode(['success' => $success, 'message' => $message], JSON_UNESCAPED_UNICODE);
    exit;
}

// Function to clean text input with proper UTF-8 handling
function cleanTextInput($input) {
    if ($input === null || $input === '') {
        return '';
    }
    
    // Ensure UTF-8 encoding
    if (!mb_check_encoding($input, 'UTF-8')) {
        $input = mb_convert_encoding($input, 'UTF-8', 'UTF-8');
    }
    
    // Remove magic quotes if enabled
    if (function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc()) {
        $input = stripslashes($input);
    }
    
    // Fix any escaped apostrophes
    $input = str_replace(["\\'", '\\"'], ["'", '"'], $input);
    
    // Convert Windows/Mac line endings to Unix format
    $input = str_replace(["\r\n", "\r"], "\n", $input);
    
    // Remove any duplicate newlines (but keep intentional ones)
    $input = preg_replace("/\n{3,}/", "\n\n", $input);
    
    // Trim whitespace from both ends
    $input = trim($input);
    
    // Remove any null bytes
    $input = str_replace("\0", '', $input);
    
    return $input;
}

// Only process POST requests
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    sendResponse(false, "Invalid request method");
}

// Validate spot ID
if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
    sendResponse(false, "Invalid spot ID");
}

$id = intval($_POST['id']);

// Clean and validate basic fields
$name = isset($_POST['name']) ? cleanTextInput($_POST['name']) : '';
if (empty($name)) {
    sendResponse(false, "Spot name is required");
}

// Handle multiple categories
$categories = [];
if (isset($_POST['categories']) && is_array($_POST['categories'])) {
    $categories = array_map('cleanTextInput', $_POST['categories']);
} elseif (isset($_POST['category'])) {
    $categories = [cleanTextInput($_POST['category'])];
}

// Validate at least one category
if (empty($categories)) {
    sendResponse(false, "At least one category is required");
}

// Convert array to comma-separated string for storage
$category = implode(', ', $categories);

// Get and validate safety level
$safety_level = isset($_POST['safety_level']) ? cleanTextInput($_POST['safety_level']) : 'safe';
$valid_safety_levels = ['safe', 'caution', 'dangerous'];
if (!in_array($safety_level, $valid_safety_levels)) {
    sendResponse(false, "Invalid safety level. Must be 'safe', 'caution', or 'dangerous'");
}

// Get annual visitors
$annual_visitors = isset($_POST['annual_visitors']) ? intval($_POST['annual_visitors']) : 0;

// Clean text fields while preserving newlines and formatting
$overview = isset($_POST['overview']) ? cleanTextInput($_POST['overview']) : '';
$things_to_do = isset($_POST['things_to_do']) ? cleanTextInput($_POST['things_to_do']) : '';
$operating_hours = isset($_POST['operating_hours']) ? cleanTextInput($_POST['operating_hours']) : '';
$nearby_accommodations = isset($_POST['nearby_accommodations']) ? cleanTextInput($_POST['nearby_accommodations']) : '';
$nearby_restaurants = isset($_POST['nearby_restaurants']) ? cleanTextInput($_POST['nearby_restaurants']) : '';
$contact_information = isset($_POST['contact_information']) ? cleanTextInput($_POST['contact_information']) : '';
$official_links = isset($_POST['official_links']) ? cleanTextInput($_POST['official_links']) : '';
$transportation = isset($_POST['transportation']) ? cleanTextInput($_POST['transportation']) : '';

// Location fields
$region = isset($_POST['region']) ? cleanTextInput($_POST['region']) : '';
$province = isset($_POST['province']) ? cleanTextInput($_POST['province']) : '';
$municipality = isset($_POST['municipality']) ? cleanTextInput($_POST['municipality']) : '';
$local_languages = isset($_POST['local_languages']) ? cleanTextInput($_POST['local_languages']) : '';

// GPS Coordinates fields - CHANGED FROM top_position/left_position
$latitude = isset($_POST['latitude']) ? floatval($_POST['latitude']) : 0;
$longitude = isset($_POST['longitude']) ? floatval($_POST['longitude']) : 0;

// Validate coordinates are within valid ranges
if ($latitude < -90 || $latitude > 90) {
    sendResponse(false, "Invalid latitude. Must be between -90 and 90");
}
if ($longitude < -180 || $longitude > 180) {
    sendResponse(false, "Invalid longitude. Must be between -180 and 180");
}

// Prepare UPDATE statement - CHANGED to use latitude/longitude
$sql = "UPDATE spot_info SET 
        name = ?, 
        category = ?, 
        safety_level = ?,
        annual_visitors = ?,
        overview = ?, 
        things_to_do = ?, 
        operating_hours = ?, 
        nearby_accommodations = ?, 
        nearby_restaurants = ?, 
        contact_information = ?, 
        official_links = ?, 
        transportation = ?, 
        region = ?, 
        province = ?, 
        municipality = ?,
        local_languages = ?,
        latitude = ?, 
        longitude = ?
        WHERE id = ?";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    sendResponse(false, "Database error: Unable to prepare statement");
}

// Bind parameters - CHANGED parameter types for latitude/longitude
// 2 strings (name, category), 1 string (safety_level), 1 integer (annual_visitors),
// 12 strings (text fields), 2 doubles (latitude, longitude), 1 integer (id)
$stmt->bind_param(
    "sssissssssssssssddi",
    $name,
    $category,
    $safety_level,
    $annual_visitors,
    $overview,
    $things_to_do,
    $operating_hours,
    $nearby_accommodations,
    $nearby_restaurants,
    $contact_information,
    $official_links,
    $transportation,
    $region,
    $province,
    $municipality,
    $local_languages,
    $latitude,
    $longitude,
    $id
);

// Execute the update
if (!$stmt->execute()) {
    $stmt->close();
    $conn->close();
    sendResponse(false, "Failed to update spot information");
}

$stmt->close();

// Handle owner updates for existing images
if (isset($_POST['image_owners']) && is_array($_POST['image_owners'])) {
    foreach ($_POST['image_owners'] as $image_id => $owner_name) {
        $image_id = intval($image_id);
        $owner_name = cleanTextInput($owner_name);
        
        $update_owner_sql = "UPDATE spot_images SET owner_name = ? WHERE id = ? AND spot_id = ?";
        $update_owner_stmt = $conn->prepare($update_owner_sql);
        
        if ($update_owner_stmt) {
            $update_owner_stmt->bind_param("sii", $owner_name, $image_id, $id);
            $update_owner_stmt->execute();
            $update_owner_stmt->close();
        }
    }
}

// Handle new image uploads
$upload_messages = [];
if (!empty($_FILES['new_images']['name'][0])) {
    $base_dir = dirname(__FILE__);
    $images_dir = $base_dir . '/images';
    $upload_dir = $images_dir . '/uploads/';
    $db_image_dir = 'images/uploads/';
    
    // Create directories if they don't exist
    if (!is_dir($images_dir)) {
        mkdir($images_dir, 0755, true);
    }
    
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }
    
    // Check if directory is writable
    if (!is_writable($upload_dir)) {
        $conn->close();
        sendResponse(false, "Upload directory is not writable");
    }
    
    // Get owner name for new images
    $new_image_owner = isset($_POST['new_image_owner']) ? 
        cleanTextInput($_POST['new_image_owner']) : 'Unknown Photographer';
    
    $upload_success = 0;
    $upload_errors = [];
    
    foreach ($_FILES['new_images']['tmp_name'] as $key => $tmp_name) {
        if ($_FILES['new_images']['error'][$key] === UPLOAD_ERR_OK) {
            $image_name = $_FILES['new_images']['name'][$key];
            $image_tmp = $_FILES['new_images']['tmp_name'][$key];
            
            // Validate file type
            $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            $file_info = finfo_open(FILEINFO_MIME_TYPE);
            $file_type = finfo_file($file_info, $image_tmp);
            finfo_close($file_info);
            
            if (!in_array($file_type, $allowed_types)) {
                $upload_errors[] = "Invalid file type for " . $image_name;
                continue;
            }
            
            // Generate unique filename
            $extension = pathinfo($image_name, PATHINFO_EXTENSION);
            $clean_name = preg_replace('/[^a-zA-Z0-9]/', '_', pathinfo($image_name, PATHINFO_FILENAME));
            $unique_name = uniqid() . '_' . $clean_name . '.' . $extension;
            $image_path = $db_image_dir . $unique_name;
            $full_path = $upload_dir . $unique_name;
            
            if (move_uploaded_file($image_tmp, $full_path)) {
                if (file_exists($full_path)) {
                    $insert_sql = "INSERT INTO spot_images (spot_id, image_path, owner_name) VALUES (?, ?, ?)";
                    $insert_stmt = $conn->prepare($insert_sql);
                    
                    if ($insert_stmt) {
                        $insert_stmt->bind_param("iss", $id, $image_path, $new_image_owner);
                        if ($insert_stmt->execute()) {
                            $upload_success++;
                        } else {
                            $upload_errors[] = "Database error for " . $image_name;
                            unlink($full_path);
                        }
                        $insert_stmt->close();
                    } else {
                        $upload_errors[] = "Database preparation error for " . $image_name;
                        unlink($full_path);
                    }
                } else {
                    $upload_errors[] = "File verification failed for " . $image_name;
                }
            } else {
                $upload_errors[] = "Failed to upload " . $image_name;
            }
        }
    }
    
    // Build success message
    if ($upload_success > 0) {
        $upload_messages[] = $upload_success . " new image(s) uploaded";
    }
    if (!empty($upload_errors)) {
        $upload_messages[] = "Some uploads failed: " . implode(", ", $upload_errors);
    }
}

$conn->close();

// Build final response message
$message = "Tourism spot updated successfully!";
if (!empty($upload_messages)) {
    $message .= " " . implode(". ", $upload_messages) . ".";
}

sendResponse(true, $message);
?>