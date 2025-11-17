<?php
$servername = "sql103.infinityfree.com";
$username = "if0_39925056";
$password = "CAQpbXykjVsU";
$dbname = "if0_39925056_tourismmap";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['error' => 'Connection failed: ' . $conn->connect_error]));
}

// Set character set
$conn->set_charset("utf8mb4");

try {
    // Get basic statistics
    $stats = [];
    
    // Total destinations
    $result = $conn->query("SELECT COUNT(*) as total FROM spot_info");
    $stats['total_destinations'] = $result->fetch_assoc()['total'];
    
    // Total users
    $result = $conn->query("SELECT COUNT(*) as total FROM users");
    $stats['total_users'] = $result->fetch_assoc()['total'];
    
    // Total reviews/ratings
    $result = $conn->query("SELECT COUNT(*) as total FROM ratings");
    $stats['total_reviews'] = $result->fetch_assoc()['total'];
    
    // Total messages (assuming you have a contact_messages table)
    $result = $conn->query("SHOW TABLES LIKE 'contact_messages'");
    if ($result->num_rows > 0) {
        $result = $conn->query("SELECT COUNT(*) as total FROM contact_messages");
        $stats['total_messages'] = $result->fetch_assoc()['total'];
    } else {
        $stats['total_messages'] = 0;
    }
    
    // Destinations by category
    $result = $conn->query("
        SELECT category, COUNT(*) as count 
        FROM spot_info 
        GROUP BY category 
        ORDER BY count DESC
    ");
    $categories = [];
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }
    $stats['categories'] = $categories;
    
    // Rating distribution
    $result = $conn->query("
        SELECT rating, COUNT(*) as count 
        FROM ratings 
        GROUP BY rating 
        ORDER BY rating ASC
    ");
    $ratings = [];
    while ($row = $result->fetch_assoc()) {
        $ratings[] = $row;
    }
    $stats['ratings'] = $ratings;
    
    // Regional distribution
    $result = $conn->query("
        SELECT region, COUNT(*) as count 
        FROM spot_info 
        WHERE region IS NOT NULL AND region != ''
        GROUP BY region 
        ORDER BY count DESC 
        LIMIT 10
    ");
    $regions = [];
    while ($row = $result->fetch_assoc()) {
        $regions[] = $row;
    }
    $stats['regions'] = $regions;
    
    // User registration trend (last 12 months)
    $result = $conn->query("
        SELECT 
            DATE_FORMAT(created_at, '%M %Y') as month,
            COUNT(*) as count
        FROM users 
        WHERE created_at >= DATE_SUB(NOW(), INTERVAL 12 MONTH)
        GROUP BY YEAR(created_at), MONTH(created_at)
        ORDER BY created_at ASC
        LIMIT 12
    ");
    $user_trend = [];
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $user_trend[] = $row;
        }
    }
    $stats['user_trend'] = $user_trend;
    
    // Average rating per destination
    $result = $conn->query("
        SELECT 
            s.name,
            AVG(r.rating) as avg_rating,
            COUNT(r.rating) as review_count
        FROM spot_info s
        LEFT JOIN ratings r ON s.id = r.spot_id
        GROUP BY s.id, s.name
        HAVING review_count > 0
        ORDER BY avg_rating DESC
        LIMIT 10
    ");
    $top_rated = [];
    while ($row = $result->fetch_assoc()) {
        $top_rated[] = [
            'name' => $row['name'],
            'avg_rating' => round($row['avg_rating'], 1),
            'review_count' => $row['review_count']
        ];
    }
    $stats['top_rated'] = $top_rated;
    
    // Most visited destinations (by annual_visitors)
    $result = $conn->query("
        SELECT name, annual_visitors 
        FROM spot_info 
        WHERE annual_visitors > 0 
        ORDER BY annual_visitors DESC 
        LIMIT 10
    ");
    $most_visited = [];
    while ($row = $result->fetch_assoc()) {
        $most_visited[] = $row;
    }
    $stats['most_visited'] = $most_visited;
    
    // Safety level distribution
    $result = $conn->query("
        SELECT 
            CASE 
                WHEN safety_level = 'safe' THEN 'Safe'
                WHEN safety_level = 'caution' THEN 'Caution'
                WHEN safety_level = 'dangerous' THEN 'Dangerous'
                ELSE 'Unknown'
            END as safety_level,
            COUNT(*) as count 
        FROM spot_info 
        GROUP BY safety_level
    ");
    $safety_levels = [];
    while ($row = $result->fetch_assoc()) {
        $safety_levels[] = $row;
    }
    $stats['safety_levels'] = $safety_levels;
    
    header('Content-Type: application/json');
    echo json_encode($stats, JSON_UNESCAPED_UNICODE);
    
} catch (Exception $e) {
    header('Content-Type: application/json');
    echo json_encode(['error' => $e->getMessage()]);
}

$conn->close();
?>