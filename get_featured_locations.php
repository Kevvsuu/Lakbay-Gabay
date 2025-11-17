<?php
$servername = "sql103.infinityfree.com";
$username = "if0_39925056";
$password = "CAQpbXykjVsU";
$dbname = "if0_39925056_tourismmap";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(['error' => 'Connection failed: ' . $conn->connect_error]);
    exit;
}

// Set character set
$conn->set_charset("utf8mb4");

try {
    // Query to get FEATURED locations with their images and ratings
    $query = "SELECT spot_info.id,
          spot_info.name,
          spot_info.category,
          spot_info.overview,
          spot_info.region,
          spot_info.province,
          spot_info.municipality,
          spot_info.latitude,
          spot_info.longitude,
          spot_info.safety_level,
          spot_info.annual_visitors,
          GROUP_CONCAT(DISTINCT spot_images.image_path ORDER BY spot_images.id) AS image_paths,
          GROUP_CONCAT(COALESCE(spot_images.owner_name, 'Unknown Photographer') ORDER BY spot_images.id) AS image_owners,
          AVG(ratings.rating) as avg_rating,
          COUNT(DISTINCT ratings.id) as rating_count
          FROM spot_info 
          LEFT JOIN spot_images ON spot_info.id = spot_images.spot_id 
          LEFT JOIN ratings ON spot_info.id = ratings.spot_id
          WHERE spot_info.featured = 1
          GROUP BY spot_info.id
          ORDER BY spot_info.annual_visitors DESC, spot_info.id DESC
          LIMIT 100";

    $result = $conn->query($query);

    if (!$result) {
        throw new Exception("Query failed: " . $conn->error);
    }

    $featured_locations = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Validate coordinates
            $latitude = !empty($row['latitude']) ? floatval($row['latitude']) : null;
            $longitude = !empty($row['longitude']) ? floatval($row['longitude']) : null;
            
            // Skip if coordinates are missing
            if ($latitude === null || $longitude === null || $latitude === 0 || $longitude === 0) {
                error_log("Warning: Featured location '{$row['name']}' has invalid coordinates: lat={$latitude}, lng={$longitude}");
                continue; // Skip this location
            }
            
            // Process images
            $images = [];
            if (!empty($row['image_paths'])) {
                $images = explode(',', $row['image_paths']);
                // Clean up image paths and ensure correct path format
                $images = array_map(function($path) {
                    $path = trim($path);
                    
                    // Remove any '../' prefixes
                    $path = str_replace('../', '', $path);
                    
                    // If path starts with 'uploads/', change to 'images/uploads/'
                    if (strpos($path, 'uploads/') === 0) {
                        $path = 'images/' . $path;
                    }
                    // If path doesn't start with 'images/' and isn't a full URL, add 'images/'
                    else if (strpos($path, 'images/') !== 0 && 
                            strpos($path, 'http') !== 0 &&
                            strpos($path, '/') !== 0) {
                        $path = 'images/' . $path;
                    }
                    
                    return $path;
                }, $images);
            }
            
            // Add placeholder if no images
            if (empty($images)) {
                $images = ['images/placeholder-destination.jpg'];
            }

            // Process image owners
            $image_owners = [];
            if (!empty($row['image_owners'])) {
                $image_owners = explode(',', $row['image_owners']);
                $image_owners = array_map('trim', $image_owners);
            }

            // Ensure image_owners array matches the length of images array
            $image_count = count($images);
            $owner_count = count($image_owners);
            
            if ($owner_count < $image_count) {
                // Pad with 'Unknown Photographer' if we have fewer owners than images
                for ($i = $owner_count; $i < $image_count; $i++) {
                    $image_owners[] = 'Unknown Photographer';
                }
            } elseif ($owner_count > $image_count) {
                // Trim owners array if we have more owners than images
                $image_owners = array_slice($image_owners, 0, $image_count);
            }

            // Calculate average rating
            $avg_rating = 0;
            if ($row['avg_rating'] && $row['rating_count'] > 0) {
                $avg_rating = round(floatval($row['avg_rating']), 1);
            }

            $featured_locations[] = [
                'id' => intval($row['id']),
                'name' => $row['name'],
                'category' => $row['category'],
                'overview' => $row['overview'],
                'region' => $row['region'],
                'province' => $row['province'],
                'municipality' => $row['municipality'],
                'latitude' => $latitude,
                'longitude' => $longitude,
                'safety_level' => $row['safety_level'] ?? 'safe',
                'annual_visitors' => intval($row['annual_visitors'] ?? 0),
                'images' => $images,
                'image_owners' => $image_owners,
                'avg_rating' => $avg_rating,
                'rating_count' => intval($row['rating_count'] ?? 0)
            ];
        }
    }

    $conn->close();

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($featured_locations, JSON_UNESCAPED_SLASHES);

} catch (Exception $e) {
    // Ensure we're outputting JSON even for errors
    if ($conn) {
        $conn->close();
    }
    http_response_code(500);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['error' => 'An error occurred: ' . $e->getMessage()]);
}