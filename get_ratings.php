<?php
$servername = "sql103.infinityfree.com";
$username = "if0_39925056";
$password = "CAQpbXykjVsU";
$dbname = "if0_39925056_tourismmap";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT r.id, u.username, s.name as spot_name, r.rating, r.comment 
          FROM ratings r
          JOIN users u ON r.user_id = u.id
          JOIN spot_info s ON r.spot_id = s.id";
$result = mysqli_query($conn, $query);

$ratings = [];

if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $ratings[] = $row;
    }
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($ratings);
?>