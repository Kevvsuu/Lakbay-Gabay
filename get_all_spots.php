<?php
// Start output buffering FIRST to catch any stray output
ob_start();

// Turn off ALL error display
ini_set('display_errors', 0);
ini_set('log_errors', 1);
error_reporting(0);

$servername = "sql103.infinityfree.com";
$username = "if0_39925056";
$password = "CAQpbXykjVsU";
$dbname = "if0_39925056_tourismmap";

// Set header BEFORE any output
header('Content-Type: application/json; charset=utf-8');

try {
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
    
    // Set charset
    $conn->set_charset("utf8mb4");
    
    // Check if search parameter is provided
    $search = '';
    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $search = '%' . $_GET['search'] . '%';
        $query = "SELECT id, name, category, annual_visitors, featured FROM spot_info 
                  WHERE name LIKE ? OR category LIKE ? 
                  ORDER BY name ASC";
        $stmt = $conn->prepare($query);
        
        if (!$stmt) {
            throw new Exception("Error preparing statement: " . $conn->error);
        }
        
        $stmt->bind_param("ss", $search, $search);
        $stmt->execute();
        $result = $stmt->get_result();
    } else {
        $query = "SELECT id, name, category, annual_visitors, featured FROM spot_info ORDER BY name ASC";
        $result = $conn->query($query);
        
        if (!$result) {
            throw new Exception("Error executing query: " . $conn->error);
        }
    }
    
    $data = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Ensure featured is an integer (0 or 1)
            $row['featured'] = (int)$row['featured'];
            $row['annual_visitors'] = (int)$row['annual_visitors'];
            $data[] = $row;
        }
    }
    
    if (isset($stmt)) {
        $stmt->close();
    }
    $conn->close();
    
    // Clear any output that might have been captured
    ob_clean();
    
    // Output JSON
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    
} catch (Exception $e) {
    // Clear any output
    ob_clean();
    
    http_response_code(500);
    echo json_encode([
        "error" => $e->getMessage(),
        "success" => false
    ], JSON_UNESCAPED_UNICODE);
}

// Flush output buffer
ob_end_flush();
?>