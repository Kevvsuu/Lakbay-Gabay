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

// Set character set to avoid encoding issues
$conn->set_charset("utf8mb4");

$query = "SELECT spot_info.*, 
          GROUP_CONCAT(spot_images.image_path ORDER BY spot_images.id) AS images,
          GROUP_CONCAT(COALESCE(spot_images.owner_name, 'Unknown Photographer') ORDER BY spot_images.id) AS image_owners
          FROM spot_info 
          LEFT JOIN spot_images ON spot_info.id = spot_images.spot_id 
          GROUP BY spot_info.id";
          
$result = $conn->query($query);
$data = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Process images and owners
        $row['images'] = !empty($row['images']) ? explode(',', $row['images']) : [];
        $row['image_owners'] = !empty($row['image_owners']) ? explode(',', $row['image_owners']) : [];
        
        // Ensure owners array has same length as images array
        if (count($row['image_owners']) < count($row['images'])) {
            $missing = count($row['images']) - count($row['image_owners']);
            for ($i = 0; $i < $missing; $i++) {
                $row['image_owners'][] = 'Unknown Photographer';
            }
        }
        
        // Convert category string to array
        if (isset($row['category']) && !empty($row['category'])) {
            $row['categories'] = array_map('trim', explode(',', $row['category']));
        } else {
            $row['categories'] = [];
        }
        
        // Convert latitude and longitude to float for proper JSON representation
        if (isset($row['latitude']) && $row['latitude'] !== null) {
            $row['latitude'] = floatval($row['latitude']);
        }
        if (isset($row['longitude']) && $row['longitude'] !== null) {
            $row['longitude'] = floatval($row['longitude']);
        }
        
        // Create a coordinates object for easier map integration
        $row['coordinates'] = [
            'lat' => $row['latitude'],
            'lng' => $row['longitude']
        ];
        
        $data[] = $row;
    }
}

$conn->close();

header('Content-Type: application/json; charset=utf-8');
echo json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
?>