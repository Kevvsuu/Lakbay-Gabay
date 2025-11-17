<?php
$servername = "sql103.infinityfree.com";
$username = "if0_39925056";
$password = "CAQpbXykjVsU";
$dbname = "if0_39925056_tourismmap";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Directly delete the user and their associated ratings
$userId = intval($_POST['id']);

// Start a transaction to ensure data integrity
$conn->begin_transaction();

try {
    // First, delete related ratings
    $delete_ratings_sql = "DELETE FROM ratings WHERE user_id = ?";
    $ratings_stmt = $conn->prepare($delete_ratings_sql);
    $ratings_stmt->bind_param("i", $userId);
    $ratings_stmt->execute();
    $ratings_stmt->close();

    // Then delete the user
    $delete_user_sql = "DELETE FROM users WHERE id = ?";
    $user_stmt = $conn->prepare($delete_user_sql);
    $user_stmt->bind_param("i", $userId);
    $user_stmt->execute();

    // If we got here, commit the transaction
    $conn->commit();
    
    echo "User and associated ratings deleted successfully!";
} catch (Exception $e) {
    // If there was an error, roll back the transaction
    $conn->rollback();
    echo "Error deleting user: " . $e->getMessage();
}

$conn->close();
?>