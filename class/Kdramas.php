<?php
require_once __DIR__ . '/../config/db.php';

class Kdramas {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->conn;
    }

    public function getAll() {
        $stmt = $this->conn->prepare("SELECT kdrama.*, platforms.nama AS platform_name FROM kdrama 
                                      LEFT JOIN platforms ON kdrama.id_platforms = platforms.id ORDER BY kdrama.id DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM kdrama WHERE id = :id");
        $stmt->execute([':id' => $id]); 
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($judul, $genre, $tahun_liris, $id_platforms) {
        $sql = "INSERT INTO kdrama (judul, genre, tahun_liris, id_platforms) 
                VALUES (:judul, :genre, :tahun_liris, :id_platforms)";
        $stmt = $this->conn->prepare($sql);
        
        $id_platforms = $id_platforms ? (int)$id_platforms : null; 
        
        return $stmt->execute([
            ':judul' => $judul,
            ':genre' => $genre,
            ':tahun_liris' => $tahun_liris, 
            ':id_platforms' => $id_platforms
        ]);
    }

    public function update($id, $judul, $genre, $tahun_liris, $id_platforms) {
        $sql = "UPDATE kdrama SET judul = :judul, genre = :genre, tahun_liris = :tahun_liris, id_platforms = :id_platforms WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        
        $id_platforms = $id_platforms ? (int)$id_platforms : null;
        
        return $stmt->execute([
            ':id' => $id,
            ':judul' => $judul,
            ':genre' => $genre,
            ':tahun_liris' => $tahun_liris,
            ':id_platforms' => $id_platforms
        ]);
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM kdrama WHERE id= :id");
        return $stmt->execute([':id' => $id]);
    }
}
?>
