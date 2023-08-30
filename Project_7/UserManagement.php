<?php
require_once 'Database.php';
require_once 'User.php';

class UserManagement {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function addUser($user) {
        $query = "INSERT INTO users (username, email, role) VALUES ('" . $user->getUsername() . "', '" . $user->getEmail() . "', '" . $user->getRole() . "')";
        $this->db->executeQuery($query);
    }

    public function getUserById($userId) {
        $query = "SELECT * FROM users WHERE id = " . $userId;
        $result = $this->db->fetchOne($query);
        if ($result) {
            return new User($result['id'], $result['username'], $result['email'], $result['role']);
        }
        return null;
    }

    public function updateUser($user) {
        $query = "UPDATE users SET username='" . $user->getUsername() . "', email='" . $user->getEmail() . "', role='" . $user->getRole() . "' WHERE id=" . $user->getId();
        $this->db->executeQuery($query);
    }

    public function deleteUser($userId) {
        $query = "DELETE FROM users WHERE id = " . $userId;
        $this->db->executeQuery($query);
    }
}
?>
