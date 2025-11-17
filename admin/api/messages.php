<?php
session_start();
header('Content-Type: application/json');

require_once '../../config/database.php';

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit();
}

try {
    $database = new Database();
    $conn = $database->getConnection();
    
    $method = $_SERVER['REQUEST_METHOD'];
    
    // GET - Fetch messages
    if ($method === 'GET') {
        $search = $_GET['search'] ?? '';
        $status = $_GET['status'] ?? '';
        $limit = intval($_GET['limit'] ?? 10);
        $offset = intval($_GET['offset'] ?? 0);
        
        // Build query
        $where = [];
        $params = [];
        
        if (!empty($search)) {
            $where[] = "(first_name LIKE :search1 OR email LIKE :search2 OR subject LIKE :search3 OR message LIKE :search4)";
            $searchTerm = "%$search%";
            $params['search1'] = $searchTerm;
            $params['search2'] = $searchTerm;
            $params['search3'] = $searchTerm;
            $params['search4'] = $searchTerm;
        }
        
        if (!empty($status)) {
            $where[] = "status = :status";
            $params['status'] = $status;
        }
        
        $whereSQL = !empty($where) ? 'WHERE ' . implode(' AND ', $where) : '';
        
        // Get total count
        $countSQL = "SELECT COUNT(*) as total FROM contact_messages $whereSQL";
        $stmt = $conn->prepare($countSQL);
        $stmt->execute($params);
        $total = $stmt->fetch()['total'];
        
        // Get messages
        $sql = "SELECT 
                    id, user_id, first_name, last_name, email, phone, 
                    subject, message, status, created_at, updated_at
                FROM contact_messages 
                $whereSQL 
                ORDER BY created_at DESC 
                LIMIT :limit OFFSET :offset";
        
        $stmt = $conn->prepare($sql);
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        
        $messages = [];
        while ($row = $stmt->fetch()) {
            $row['full_name'] = trim($row['first_name'] . ' ' . $row['last_name']);
            $row['message_preview'] = substr($row['message'], 0, 100);
            $row['created_at_formatted'] = date('M j, Y g:i A', strtotime($row['created_at']));
            $messages[] = $row;
        }
        
        echo json_encode([
            'success' => true,
            'data' => $messages,
            'total' => $total,
            'limit' => $limit,
            'offset' => $offset
        ]);
    }
    
    // POST - Update or Delete
    else if ($method === 'POST') {
        $input = json_decode(file_get_contents('php://input'), true);
        $action = $input['action'] ?? '';
        
        if ($action === 'update') {
            $id = intval($input['id']);
            $status = $input['status'];
            
            $sql = "UPDATE contact_messages SET status = ?, updated_at = CURRENT_TIMESTAMP WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$status, $id]);
            
            echo json_encode(['success' => true, 'message' => 'Message updated successfully']);
        }
        else if ($action === 'delete') {
            $id = intval($input['id']);
            
            $sql = "DELETE FROM contact_messages WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$id]);
            
            echo json_encode(['success' => true, 'message' => 'Message deleted successfully']);
        }
        else {
            echo json_encode(['success' => false, 'message' => 'Invalid action']);
        }
    }
    
} catch (Exception $e) {
    error_log("Messages API error: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>