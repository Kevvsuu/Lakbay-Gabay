<?php
header('Content-Type: application/json');

$servername = "sql103.infinityfree.com";
$username = "if0_39925056";
$password = "CAQpbXykjVsU";
$dbname = "if0_39925056_tourismmap";

try {
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    // Check if spot_id is set and is a valid integer
    if (!isset($_POST['spot_id']) || !is_numeric($_POST['spot_id'])) {
        throw new Exception("Invalid or missing spot ID");
    }

    $spot_id = intval($_POST['spot_id']);

    // First, delete all related ratings
    $delete_ratings_sql = "DELETE FROM ratings WHERE spot_id = ?";
    $delete_ratings_stmt = $conn->prepare($delete_ratings_sql);
    $delete_ratings_stmt->bind_param("i", $spot_id);
    $delete_ratings_stmt->execute();
    $delete_ratings_stmt->close();

    // Then find all associated image paths
    $image_query = "SELECT image_path FROM spot_images WHERE spot_id = ?";
    $image_stmt = $conn->prepare($image_query);
    $image_stmt->bind_param("i", $spot_id);
    $image_stmt->execute();
    $image_result = $image_stmt->get_result();

    // Delete associated image files
    while ($row = $image_result->fetch_assoc()) {
        $image_path = $row['image_path'];
        if (file_exists($image_path)) {
            unlink($image_path);
        }
    }
    $image_stmt->close();

    // Delete spot images from database
    $delete_images_sql = "DELETE FROM spot_images WHERE spot_id = ?";
    $delete_images_stmt = $conn->prepare($delete_images_sql);
    $delete_images_stmt->bind_param("i", $spot_id);
    $delete_images_stmt->execute();
    $delete_images_stmt->close();

    // Finally, delete the spot from the spot_info table
    $delete_spot_sql = "DELETE FROM spot_info WHERE id = ?";
    $delete_spot_stmt = $conn->prepare($delete_spot_sql);
    $delete_spot_stmt->bind_param("i", $spot_id);
    $delete_spot_stmt->execute();

    // Check if any rows were actually deleted
    if ($delete_spot_stmt->affected_rows > 0) {
        echo json_encode([
            'success' => true, 
            'message' => "Spot and all related data deleted successfully."
        ]);
    } else {
        throw new Exception("No spot found with the given ID.");
    }

    $delete_spot_stmt->close();
    $conn->close();

} catch (Exception $e) {
    echo json_encode([
        'success' => false, 
        'message' => $e->getMessage()
    ]);
    
    // Optional: log the error
    error_log($e->getMessage());
}
?>