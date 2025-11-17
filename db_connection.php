<?php
class Database {
    private $host = 'sql103.infinityfree.com';
    private $db_name = 'if0_39925056_tourismmap';
    private $username = 'if0_39925056';
    private $password = 'CAQpbXykjVsU';
    public $conn;

    public function getConnection() {
        try {
            $this->conn = new mysqli(
                $this->host, 
                $this->username, 
                $this->password, 
                $this->db_name
            );

            if ($this->conn->connect_error) {
                throw new Exception("Connection failed: " . $this->conn->connect_error);
            }

            return $this->conn;
        } catch(Exception $e) {
            die("Database Connection Error: " . $e->getMessage());
        }
    }
}
?>