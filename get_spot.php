<?php
// Enable error reporting for debugging (remove in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set headers first
header('Content-Type: application/json; charset=utf-8');

// Database configuration
$servername = "sql103.infinityfree.com";
$username = "if0_39925056"; 
$password = "CAQpbXykjVsU"; 
$dbname = "if0_39925056_tourismmap";

// Function to send JSON response and exit
function sendJsonResponse($data, $httpCode = 200) {
    http_response_code($httpCode);
    echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    exit();
}

// Function to clean and normalize text fields
function cleanTextField($text) {
    if (is_null($text)) {
        return null;
    }
    
    // Replace all newline representations with single UNIX newlines
    $text = str_replace(["\r\n", "\r", "\\r", "\\n"], "\n", $text);
    
    // Remove any duplicate newlines
    $text = preg_replace("/\n+/", "\n", $text);
    
    // Trim whitespace and newlines from both ends
    return trim($text);
}

// Function to convert category string to array
function parseCategoryField($category) {
    if (empty($category)) {
        return [];
    }
    
    // Split by comma and trim each item
    $categories = array_map('trim', explode(',', $category));
    
    // Remove empty values
    return array_filter($categories);
}

// Check if ID parameter exists and is valid
if (!isset($_GET['id'])) {
    sendJsonResponse(["error" => "Missing ID parameter"], 400);
}

if (!is_numeric($_GET['id'])) {
    sendJsonResponse(["error" => "Invalid ID parameter - must be numeric"], 400);
}

$id = intval($_GET['id']);

// Establish database connection with error handling
$conn = null;
try {
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Check connection
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
    
    // Set charset to handle special characters properly
    $conn->set_charset("utf8mb4");
    
} catch (Exception $e) {
    sendJsonResponse(["error" => "Database connection failed: " . $e->getMessage()], 500);
}

try {
    // Prepare and execute the query
    $query = "SELECT spot_info.*, 
             spot_images.id as image_id, 
             spot_images.image_path, 
             spot_images.owner_name 
             FROM spot_info 
             LEFT JOIN spot_images ON spot_info.id = spot_images.spot_id 
             WHERE spot_info.id = ? 
             ORDER BY spot_images.id ASC";
             
    $stmt = $conn->prepare($query);
    
    if (!$stmt) {
        throw new Exception("Prepare failed: " . $conn->error);
    }
    
    $stmt->bind_param("i", $id);
    
    if (!$stmt->execute()) {
        throw new Exception("Execute failed: " . $stmt->error);
    }
    
    $result = $stmt->get_result();
    
    if (!$result) {
        throw new Exception("Get result failed: " . $stmt->error);
    }
    
    if ($result->num_rows > 0) {
        $spot = null;
        $images = [];
        $image_owners = [];
        $image_ids = [];
        
        while ($row = $result->fetch_assoc()) {
            if ($spot === null) {
                // Get the main spot data (first row)
                $spot = $row;
                // Remove image-specific fields from main spot data
                unset($spot['image_id']);
                unset($spot['image_path']);
                unset($spot['owner_name']);
                
                // Ensure safety_level field exists with default value if missing
                if (!array_key_exists('safety_level', $spot) || empty($spot['safety_level'])) {
                    $spot['safety_level'] = 'safe';
                }
            }
            
            // Collect images, their owners, and IDs
            if (!empty($row['image_path'])) {
                $images[] = $row['image_path'];
                $image_owners[] = $row['owner_name'] ? $row['owner_name'] : 'Unknown';
                $image_ids[] = $row['image_id'];
            }
        }
        
        // Add images, owners, and IDs to spot data
        $spot['images'] = $images;
        $spot['image_owners'] = $image_owners;
        $spot['image_ids'] = $image_ids;
        
        // Convert category string to array
        if (isset($spot['category'])) {
            $spot['categories'] = parseCategoryField($spot['category']);
            // Keep the original for backward compatibility
            // $spot['category'] is still available as comma-separated string
        }
        
        // List of all text fields that need cleaning
        $textFields = [
            'overview', 'professional_review', 'things_to_do',
            'operating_hours', 'nearby_accommodations',
            'nearby_restaurants', 'contact_information',
            'official_links', 'transportation'
        ];
        
        // Clean each text field
        foreach ($textFields as $field) {
            if (array_key_exists($field, $spot)) {
                $spot[$field] = cleanTextField($spot[$field]);
            }
        }
        
        // Ensure all expected fields are present with default values
        $defaultFields = [
            'things_to_do' => '',
            'operating_hours' => '',
            'nearby_accommodations' => '',
            'nearby_restaurants' => '',
            'contact_information' => '',
            'official_links' => '',
            'transportation' => '',
            'local_languages' => '',
            'latitude' => null,
            'longitude' => null
        ];
        
        foreach ($defaultFields as $field => $defaultValue) {
            if (!array_key_exists($field, $spot) || $spot[$field] === null) {
                $spot[$field] = $defaultValue;
            }
        }
        
        // Convert latitude and longitude to float for proper JSON representation
        if (isset($spot['latitude'])) {
            $spot['latitude'] = floatval($spot['latitude']);
        }
        if (isset($spot['longitude'])) {
            $spot['longitude'] = floatval($spot['longitude']);
        }
        
        // Create a coordinates object for easier map integration
        $spot['coordinates'] = [
            'lat' => $spot['latitude'],
            'lng' => $spot['longitude']
        ];
        
        sendJsonResponse($spot);
        
    } else {
        sendJsonResponse(["error" => "Spot not found"], 404);
    }
    
} catch (Exception $e) {
    error_log("Database error in get_spot.php: " . $e->getMessage());
    sendJsonResponse(["error" => "Database error: " . $e->getMessage()], 500);
    
} finally {
    // Clean up resources
    if (isset($stmt)) {
        $stmt->close();
    }
    if ($conn) {
        $conn->close();
    }
}
?>