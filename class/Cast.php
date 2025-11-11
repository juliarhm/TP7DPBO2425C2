<?php
require_once __DIR__ . '/../config/db.php';

enum Gender: string {
    case Pria = 'Pria';
    case Wanita = 'Wanita';
}

class Cast {
    private $conn;

    public function __construct() {
        $database = new Database(); 
        $this->conn = $database->conn; 
    }

    public function getAll() {
        $stmt = $this->conn->prepare("SELECT c.*, k.judul AS kdrama_name FROM cast c
                                      LEFT JOIN kdrama k ON c.id_kdrama = k.id
                                      ORDER BY c.id DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM cast WHERE id = :id");
        $stmt->execute([':id' => $id]); 
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($nama, $jenis_kelamin, $agensi, $id_kdrama) {
        $sql = "INSERT INTO cast (nama, jenis_kelamin, agensi, id_kdrama) 
                VALUES (:nama, :jk, :agensi, :id_kdrama)";
        $stmt = $this->conn->prepare($sql);
        $id_kdrama = $id_kdrama ? (int)$id_kdrama : null; 
        return $stmt->execute([
            ':nama' => $nama,
            ':jk' => $jenis_kelamin,
            ':agensi' => $agensi,
            ':id_kdrama' => $id_kdrama 
        ]);
    }
    
    public function update($id, $nama, $jenis_kelamin, $agensi, $id_kdrama) {
        $sql = "UPDATE cast SET nama = :nama, jenis_kelamin = :jk, agensi = :agensi, id_kdrama = :id_kdrama WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        
        $id_kdrama = $id_kdrama ? (int)$id_kdrama : null; 
        
        return $stmt->execute([
            ':id' => $id,
            ':nama' => $nama,
            ':jk' => $jenis_kelamin,
            ':agensi' => $agensi,
            ':id_kdrama' => $id_kdrama 
        ]);
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM cast WHERE id = :id");

        return $stmt->execute([
            ':id' => $id
        ]);
    }
}
?>