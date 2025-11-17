<?php
session_start();
header('Content-Type: application/json');

require_once 'db_connection.php';

class AdminLogin {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function login($username, $password) {
        // Basic input validation
        if (empty($username) || empty($password)) {
            return $this->loginResponse(false, 'Username and password are required');
        }


        $stmt = $this->conn->prepare("SELECT * FROM admin_users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

               if ($password === $user['password']) {
                // Update last login timestamp
                $update_stmt = $this->conn->prepare("UPDATE admin_users SET last_login = CURRENT_TIMESTAMP WHERE id = ?");
                $update_stmt->bind_param("i", $user['id']);
                $update_stmt->execute();

                // Create session
                session_regenerate_id(true);
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_username'] = $user['username'];
                $_SESSION['admin_id'] = $user['id'];

                return $this->loginResponse(true, 'Login successful', [
                    'username' => $user['username'],
                    'last_login' => $user['last_login']
                ]);
            } else {
                return $this->loginResponse(false, 'Invalid credentials');
            }
        } else {
            return $this->loginResponse(false, 'User not found');
        }
    }

    private function loginResponse($success, $message, $data = []) {
        return [
            'success' => $success,
            'message' => $message,
            'data' => $data
        ];
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    
    $database = new Database();
    $db = $database->getConnection();
    
    $adminLogin = new AdminLogin($db);
    $response = $adminLogin->login(
        $data['username'] ?? '', 
        $data['password'] ?? ''
    );
    
    echo json_encode($response);
    exit();
}