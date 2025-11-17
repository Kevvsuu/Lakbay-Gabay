<?php
$servername = "sql103.infinityfree.com";
$username = "if0_39925056";
$password = "CAQpbXykjVsU";
$dbname = "if0_39925056_tourismmap"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set character set
$conn->set_charset("utf8mb4");

// FIX: Remove any magic quotes or escaping that might be applied
function clean_input($data) {
    if (is_array($data)) {
        return array_map('clean_input', $data);
    }
    // Remove any added slashes if magic quotes are on
    if (get_magic_quotes_gpc()) {
        $data = stripslashes($data);
    }
    return trim($data);
}

// Clean all POST data
$_POST = clean_input($_POST);

// Get form data WITHOUT mysqli_real_escape_string for prepared statements
$name = $_POST['name'] ?? '';

// UPDATED: Handle multiple categories
$categories = [];
if (isset($_POST['categories']) && is_array($_POST['categories'])) {
    $categories = $_POST['categories'];
} elseif (isset($_POST['category'])) {
    // Fallback for single category (backward compatibility)
    $categories = [$_POST['category']];
}
// Convert array to comma-separated string for storage
$category = implode(', ', $categories);

$overview = $_POST['overview'] ?? '';
$things_to_do = $_POST['things_to_do'] ?? '';
$operating_hours = $_POST['operating_hours'] ?? '';
$nearby_accommodations = $_POST['nearby_accommodations'] ?? '';
$nearby_restaurants = $_POST['nearby_restaurants'] ?? '';
$contact_information = $_POST['contact_information'] ?? '';
$official_links = $_POST['official_links'] ?? '';
$transportation = $_POST['transportation'] ?? '';
$region = $_POST['region'] ?? '';
$province = $_POST['province'] ?? '';
$municipality = $_POST['municipality'] ?? '';
$local_languages = $_POST['local_languages'] ?? '';

// CHANGED: GPS Coordinates instead of percentage positions
$latitude = floatval($_POST['latitude'] ?? 0);
$longitude = floatval($_POST['longitude'] ?? 0);

$safety_level = $_POST['safety_level'] ?? 'safe';
$annual_visitors = isset($_POST['annual_visitors']) ? intval($_POST['annual_visitors']) : 0;

// Validate required fields
if (empty($category)) {
    die("Error: At least one category is required.");
}

// Validate coordinates
if ($latitude < -90 || $latitude > 90) {
    die("Error: Invalid latitude. Must be between -90 and 90.");
}
if ($longitude < -180 || $longitude > 180) {
    die("Error: Invalid longitude. Must be between -180 and 180.");
}

// Check if images are uploaded
if (!isset($_FILES['images']) || empty($_FILES['images']['name'][0])) {
    die("Error: No images uploaded.");
}

// Get image owners if provided
$image_owners = [];
if (isset($_POST['image_owners'])) {
    if (is_array($_POST['image_owners'])) {
        $image_owners = $_POST['image_owners'];
    } else {
        $image_owners = explode(',', $_POST['image_owners']);
    }
    
    // Clean up owner names WITHOUT mysqli_real_escape_string
    $image_owners = array_map(function($owner) {
        return trim($owner);
    }, $image_owners);
}

// FIXED: Create proper directory structure
$base_dir = dirname(__FILE__); // Get current script directory
$images_dir = $base_dir . '/images';
$upload_dir = $images_dir . '/uploads';

// Create images directory if it doesn't exist
if (!is_dir($images_dir)) {
    if (!mkdir($images_dir, 0755, true)) {
        die("Error: Failed to create images directory. Check permissions. Path: " . $images_dir);
    }
}

// Create uploads directory if it doesn't exist
if (!is_dir($upload_dir)) {
    if (!mkdir($upload_dir, 0755, true)) {
        die("Error: Failed to create uploads directory. Check permissions. Path: " . $upload_dir);
    }
}

// Check if directory is writable
if (!is_writable($upload_dir)) {
    die("Error: Upload directory is not writable. Please check permissions. Path: " . $upload_dir);
}

// CHANGED: Prepare SQL statement with latitude/longitude instead of top_position/left_position
$sql = "INSERT INTO spot_info (
    name, category, overview, things_to_do, operating_hours, 
    nearby_accommodations, nearby_restaurants, contact_information, official_links, 
    transportation, region, province, municipality, local_languages, latitude, longitude, safety_level, annual_visitors
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Error preparing statement: " . $conn->error);
}

// CHANGED: Bind parameters with latitude/longitude
$stmt->bind_param(
    "ssssssssssssssddsi", 
    $name, $category, $overview, $things_to_do, $operating_hours, 
    $nearby_accommodations, $nearby_restaurants, $contact_information, $official_links, 
    $transportation, $region, $province, $municipality, $local_languages, $latitude, $longitude, $safety_level, $annual_visitors
);

if ($stmt->execute()) {
    $spot_id = $stmt->insert_id;
    
    // Handle multiple image uploads
    $image_stmt = $conn->prepare("INSERT INTO spot_images (spot_id, image_path, owner_name) VALUES (?, ?, ?)");
    if (!$image_stmt) {
        die("Error preparing image statement: " . $conn->error);
    }
    
    $upload_errors = [];
    $successful_uploads = 0;
    
    foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
        if ($_FILES['images']['error'][$key] !== UPLOAD_ERR_OK) {
            $upload_errors[] = "Failed to upload " . $_FILES['images']['name'][$key] . " (Error: " . $_FILES['images']['error'][$key] . ")";
            continue; // Skip failed uploads
        }
        
        $image_name = $_FILES['images']['name'][$key];
        
        // Validate file type
        $allowed_types = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
        $file_type = $_FILES['images']['type'][$key];
        if (!in_array($file_type, $allowed_types)) {
            $upload_errors[] = "Invalid file type for " . $image_name . ". Only JPG, PNG, and GIF are allowed.";
            continue;
        }
        
        // Generate unique filename
        $extension = pathinfo($image_name, PATHINFO_EXTENSION);
        $clean_name = preg_replace('/[^a-zA-Z0-9]/', '_', pathinfo($image_name, PATHINFO_FILENAME));
        $unique_name = uniqid() . '_' . $clean_name . '.' . $extension;
        
        // Full server path for file upload
        $server_image_path = $upload_dir . "/" . $unique_name;
        
        // FIXED: Relative path for database storage (this should match what get_spot.php expects)
        $db_image_path = "images/uploads/" . $unique_name;
        
        if (move_uploaded_file($tmp_name, $server_image_path)) {
            // Verify the file was actually uploaded
            if (file_exists($server_image_path)) {
                // Get owner name for this image (if provided)
                $owner_name = isset($image_owners[$key]) ? $image_owners[$key] : 'Unknown Photographer';
                
                $image_stmt->bind_param("iss", $spot_id, $db_image_path, $owner_name);
                if ($image_stmt->execute()) {
                    $successful_uploads++;
                    // Debug: Log successful upload
                    error_log("Successfully uploaded: " . $server_image_path . " -> DB: " . $db_image_path);
                } else {
                    $upload_errors[] = "Failed to save image info to database: " . $image_stmt->error;
                    // Remove the uploaded file if database insert failed
                    unlink($server_image_path);
                }
            } else {
                $upload_errors[] = "File was moved but doesn't exist: " . $server_image_path;
            }
        } else {
            $upload_errors[] = "Failed to move uploaded file: " . $image_name;
            // Enhanced debugging
            error_log("Upload failed for: " . $image_name);
            error_log("Target path: " . $server_image_path);
            error_log("Source path: " . $tmp_name);
            error_log("Upload dir writable: " . (is_writable($upload_dir) ? 'yes' : 'no'));
            error_log("Source file exists: " . (file_exists($tmp_name) ? 'yes' : 'no'));
            error_log("Upload dir exists: " . (is_dir($upload_dir) ? 'yes' : 'no'));
        }
    }
    
    $image_stmt->close();
    
    if ($successful_uploads > 0) {
        $message = "Spot added successfully with $successful_uploads image(s) uploaded!";
        if (!empty($upload_errors)) {
            $message .= "<br>However, there were some errors:<br>" . implode("<br>", $upload_errors);
        }
        echo $message;
    } else {
        echo "Spot added but no images were uploaded successfully.<br>Errors:<br>" . implode("<br>", $upload_errors);
    }
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>