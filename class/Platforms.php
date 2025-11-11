<?php
require_once __DIR__ . '/../config/db.php';

class Platforms {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->conn;
    }

    public function getAll() {
        $stmt = $this->conn->prepare("SELECT * FROM platforms");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($name, $negara_asal) {
        $stmt = $this->conn->prepare("INSERT INTO platforms (nama, negara_asal) VALUES (:nama, :negara_asal)");
        $stmt->bindParam(':nama', $name);
        $stmt->bindParam(':negara_asal', $negara_asal);
        return $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM platforms WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM platforms WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $name, $negara_asal) {
        $stmt = $this->conn->prepare("UPDATE platforms SET nama = :nama, negara_asal = :negara_asal WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nama', $name);
        $stmt->bindParam(':negara_asal', $negara_asal);
        return $stmt->execute();
    }
}
?>