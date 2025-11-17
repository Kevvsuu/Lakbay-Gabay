<?php
session_start();
header('Content-Type: application/json');

$servername = "sql103.infinityfree.com";
$username = "if0_39925056";
$password = "CAQpbXykjVsU";
$dbname = "if0_39925056_tourismmap";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo json_encode([
        'success' => false,
        'message' => 'Database connection failed'
    ]);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && 
    !empty($_POST['username']) && 
    !empty($_POST['password'])) {
    
    $username = mysqli_real_escape_string($conn, trim($_POST['username']));
    $password = trim($_POST['password']);
    
    $sql = "SELECT id, username, password, is_verified FROM users WHERE username = '$username'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        if (password_verify($password, $row['password'])) {
            if ($row['is_verified'] == 0) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Please verify your email first. Check your inbox for the OTP code.'
                ]);
                $conn->close();
                exit();
            }
            
            session_regenerate_id(true);
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            
            // Check if preferences are set
            $pref_sql = "SELECT preferences_set FROM user_preferences WHERE user_id = " . $row['id'];
            $pref_result = $conn->query($pref_sql);
            $show_preferences_modal = false;
            
            if ($pref_result->num_rows > 0) {
                $pref_row = $pref_result->fetch_assoc();
                $show_preferences_modal = !$pref_row['preferences_set'];
            } else {
                $show_preferences_modal = true;
            }
            
            echo json_encode([
                'success' => true,
                'message' => 'Login successful!',
                'redirect' => 'map.php',
                'show_preferences_modal' => $show_preferences_modal
            ]);
            $conn->close();
            exit();
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Invalid username or password.'
            ]);
            $conn->close();
            exit();
        }
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Invalid username or password.'
        ]);
        $conn->close();
        exit();
    }
}

$conn->close();
?>