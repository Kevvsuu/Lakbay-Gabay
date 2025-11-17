<?php
session_start();
header('Content-Type: application/json');

$response = ['logged_in' => isset($_SESSION['user_id'])];

if ($response['logged_in']) {
    $servername = "sql103.infinityfree.com";
    $username = "if0_39925056";
    $password = "CAQpbXykjVsU";
    $dbname = "if0_39925056_tourismmap";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        die(json_encode(['logged_in' => false, 'error' => 'Connection failed']));
    }
    
    // FIXED: Get username, email, and user_id
    $user_id = intval($_SESSION['user_id']);
    $sql = "SELECT id, username, email FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $response['user_id'] = $row['id'];
        $response['username'] = $row['username'];
        $response['email'] = $row['email'];  // THIS WAS MISSING!
    } else {
        $response['logged_in'] = false;
    }
    
    $stmt->close();
    $conn->close();
}

echo json_encode($response);
?>