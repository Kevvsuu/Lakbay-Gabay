<?php
session_start();
$servername = "sql103.infinityfree.com";
$username = "if0_39925056";
$password = "CAQpbXykjVsU";
$dbname = "if0_39925056_tourismmap";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$spot_id = intval($_GET['spot_id']);

$query = "SELECT 
            r.id, 
            CASE 
                WHEN r.is_anonymous = 1 THEN 'Anonymous'
                ELSE u.username
            END as username,
            r.rating, 
            r.comment, 
            r.created_at,
            r.is_anonymous
          FROM ratings r
          LEFT JOIN users u ON r.user_id = u.id
          WHERE r.spot_id = ?
          ORDER BY r.created_at DESC";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $spot_id);
$stmt->execute();
$result = $stmt->get_result();

$ratings = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $ratings[] = $row;
    }
}

$stmt->close();
$conn->close();

header('Content-Type: application/json');
echo json_encode($ratings);
?>