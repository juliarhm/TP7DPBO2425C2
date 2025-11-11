<?php
// Pastikan class Kdramas dimuat
require_once __DIR__ . '/../class/Kdramas.php';

$kdramaManager = new Kdramas();
$error_message = '';
$kdrama_data = null; // Variabel untuk menyimpan data kdrama yang akan dihapus

$id = $_GET['id'] ?? null;

// 1. Cek validitas ID
if (!$id || !is_numeric($id)) {
    header("Location: ?page=kdramas");
    exit;
}

// Ambil data kdrama untuk konfirmasi yang lebih informatif
$kdrama_data = $kdramaManager->getById((int)$id);
if (!$kdrama_data) {
    echo "<p style='color:red;'>Data K-Drama dengan ID tersebut tidak ditemukan!</p>";
    exit;
}

// 2. Logika Penghapusan saat form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Hanya proses jika tombol 'Ya' yang diklik
    if (isset($_POST['konfirmasi']) && $_POST['konfirmasi'] === 'ya') {
        
        try {
            if ($kdramaManager->delete((int)$id)) {
                // Sukses: Redireksi ke halaman daftar kdramas
                header("Location: ?page=kdramas");
                exit;
            } else {
                $error_message = "Gagal menghapus K-Drama. Silakan coba lagi.";
            }
        } catch (PDOException $e) {
            // Error handling untuk Foreign Key Constraint (FK)
            // K-Drama mungkin memiliki Cast yang terhubung, yang menghalangi penghapusan
            if ($e->getCode() == 23000) {
                $error_message = "Tidak dapat menghapus K-Drama ini karena masih memiliki Cast (Pemain) yang terhubung. Hapus Cast terkait terlebih dahulu.";
            } else {
                $error_message = "Terjadi kesalahan database tak terduga: " . htmlspecialchars($e->getMessage());
            }
        }
    }
    
    // Jika tombol 'Tidak' diklik, atau proses delete gagal tapi ada error message, 
    // kita akan diarahkan kembali ke halaman daftar.
    header("Location: ?page=kdramas");
    exit;
}
?>

<h2>Hapus K-Drama</h2>

<?php if ($error_message): ?>
    <p style='color:red;'><?= htmlspecialchars($error_message) ?></p>
    <p><a href="?page=kdramas">Kembali ke Daftar K-Drama</a></p>
<?php elseif ($kdrama_data): ?>
    <p>Apakah kamu yakin ingin menghapus K-Drama **<?= htmlspecialchars($kdrama_data['judul']) ?>**?</p>

    <form method="POST">
        <input type="hidden" name="id" value="<?= (int)$id ?>"> 
        
        <button type="submit" name="konfirmasi" value="ya">Ya, Hapus Permanen</button>
        <button type="submit" name="konfirmasi" value="tidak">Tidak (Batalkan)</button> 
    </form>
<?php endif; ?>