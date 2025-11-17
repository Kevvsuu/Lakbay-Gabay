<?php
$servername = "sql103.infinityfree.com";
$username = "if0_39925056";
$password = "CAQpbXykjVsU";
$dbname = "if0_39925056_tourismmap";
$conn = new mysqli($servername, $username, $password, $dbname);

// Turn off error display to avoid HTML in JSON response
ini_set('display_errors', 0);
error_reporting(E_ALL);

if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["success" => false, "message" => "Connection failed: " . $conn->connect_error]);
    exit;
}

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // First, reset all spots to not featured
    $resetSql = "UPDATE spot_info SET featured = 0";
    if (!$conn->query($resetSql)) {
        http_response_code(500);
        echo json_encode(["success" => false, "message" => "Error resetting featured spots: " . $conn->error]);
        exit;
    }
    
    // If featured IDs are provided, update them
    if (isset($_POST['featured_ids']) && !empty($_POST['featured_ids'])) {
        $featuredIdsJson = $_POST['featured_ids'];
        $featuredIds = json_decode($featuredIdsJson);
        
        // Check if the JSON decoding was successful
        if (json_last_error() !== JSON_ERROR_NONE) {
            http_response_code(400);
            echo json_encode(["success" => false, "message" => "Invalid featured IDs format"]);
            exit;
        }
        
        if (!is_array($featuredIds) || empty($featuredIds)) {
            echo json_encode(["success" => true, "message" => "No featured spots selected."]);
            exit;
        }
        
        // Create a string of placeholders for the prepared statement
        $placeholders = implode(',', array_fill(0, count($featuredIds), '?'));
        
        // Prepare the update statement
        $updateSql = "UPDATE spot_info SET featured = 1 WHERE id IN ($placeholders)";
        $stmt = $conn->prepare($updateSql);
        
        if (!$stmt) {
            http_response_code(500);
            echo json_encode(["success" => false, "message" => "Error preparing statement: " . $conn->error]);
            exit;
        }
        
        // Bind parameters
        $types = str_repeat('i', count($featuredIds));
        $stmt->bind_param($types, ...$featuredIds);
        
        if ($stmt->execute()) {
            echo json_encode(["success" => true, "message" => "Featured spots updated successfully!"]);
        } else {
            http_response_code(500);
            echo json_encode(["success" => false, "message" => "Error updating featured spots: " . $stmt->error]);
        }
        
        $stmt->close();
    } else {
        echo json_encode(["success" => true, "message" => "All spots set as non-featured."]);
    }
} else {
    http_response_code(405);
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
}

$conn->close();
?>