<?php
$servername = "sql103.infinityfree.com";
$username = "if0_39925056";
$password = "CAQpbXykjVsU";
$dbname = "if0_39925056_tourismmap";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(['error' => 'Connection failed: ' . $conn->connect_error]));
}

$conn->set_charset("utf8mb4");

// Build query based on filters
$conditions = [];
$params = [];
$types = '';

// Search filter
if (isset($_GET['search']) && !empty(trim($_GET['search']))) {
    $search = '%' . trim($_GET['search']) . '%';
    $conditions[] = "(name LIKE ? OR category LIKE ? OR region LIKE ? OR province LIKE ? OR municipality LIKE ?)";
    $params = array_merge($params, [$search, $search, $search, $search, $search]);
    $types .= 'sssss';
}

// Category filter
if (isset($_GET['category']) && !empty(trim($_GET['category']))) {
    $category = '%' . trim($_GET['category']) . '%';
    $conditions[] = "category LIKE ?";
    $params[] = $category;
    $types .= 's';
}

// Build final query
$query = "SELECT spot_info.*, 
          GROUP_CONCAT(spot_images.image_path ORDER BY spot_images.id) AS images,
          GROUP_CONCAT(COALESCE(spot_images.owner_name, 'Unknown Photographer') ORDER BY spot_images.id) AS image_owners,
          GROUP_CONCAT(spot_images.id ORDER BY spot_images.id) AS image_ids
          FROM spot_info 
          LEFT JOIN spot_images ON spot_info.id = spot_images.spot_id";

if (!empty($conditions)) {
    $query .= " WHERE " . implode(' AND ', $conditions);
}

$query .= " GROUP BY spot_info.id ORDER BY spot_info.name ASC";

$stmt = $conn->prepare($query);

if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();

$data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Process images and owners
        $row['images'] = !empty($row['images']) ? explode(',', $row['images']) : [];
        $row['image_owners'] = !empty($row['image_owners']) ? explode(',', $row['image_owners']) : [];
        $row['image_ids'] = !empty($row['image_ids']) ? explode(',', $row['image_ids']) : [];
        
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
        
        $data[] = $row;
    }
}

$stmt->close();
$conn->close();

header('Content-Type: application/json; charset=utf-8');
echo json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
?>