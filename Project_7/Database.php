<?php
class Database {
    private $conn;

    public function __construct($host, $username, $password, $dbname) {
        $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

        try {
            $this->conn = new PDO($dsn, $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function executeQuery($query) {
        return $this->conn->query($query);
    }

    public function fetchOne($query) {
        $stmt = $this->conn->query($query);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function close() {
        $this->conn = null;
    }
}
?>

