<?php
namespace Project\Impossible\models;

use PDO;

class UserModel {
    private $id;
    private $name;
    private $email;
    private $password;
    private $created_at;
    private $updated_at;
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setPassword($password) {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    public function getPassword() {
        return $this->password;
    }

    public function setCreatedAt($created_at) {
        $this->created_at = $created_at;
    }

    public function getCreatedAt() {
        return $this->created_at;
    }

    public function setUpdatedAt($updated_at) {
        $this->updated_at = $updated_at;
    }

    public function getUpdatedAt() {
        return $this->updated_at;
    }

    public function save() {
        if ($this->id) {
            // Update existing user
            $stmt = $this->db->prepare("UPDATE users SET name = ?, email = ?, password = ?, updated_at = NOW() WHERE id = ?");
            return $stmt->execute([$this->name, $this->email, $this->password, $this->id]);
        } else {
            // Create new user
            $stmt = $this->db->prepare("INSERT INTO users (name, email, password, created_at, updated_at) VALUES (?, ?, ?, NOW(), NOW())");
            return $stmt->execute([$this->name, $this->email, $this->password]);
        }
    }

    public function delete() {
        if ($this->id) {
            $stmt = $this->db->prepare("DELETE FROM users WHERE id = ?");
            return $stmt->execute([$this->id]);
        }
        return false;
    }

    public static function findById($db, $id) {
        $stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($data) {
            $user = new self($db);
            $user->setId($data['id']);
            $user->setName($data['name']);
            $user->setEmail($data['email']);
            $user->password = $data['password']; // Assuming you don't need to re-hash password from DB
            $user->setCreatedAt($data['created_at']);
            $user->setUpdatedAt($data['updated_at']);
            return $user;
        }
        return null;
    }

    public static function findAll($db) {
        $stmt = $db->query("SELECT * FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
