<?php
require_once __DIR__ . '/../class/Cast.php';

$castManager = new Cast();
$error_message = '';
$cast_data = null; 

$id = $_GET['id'] ?? null;

// Cek validitas ID
if (!$id || !is_numeric($id)) {
    header("Location: ?page=cast");
    exit;
}

$cast_data = $castManager->getById((int)$id);
if (!$cast_data) {
    $error_message = "Data Cast dengan ID tersebut tidak ditemukan.";
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['konfirmasi']) && $_POST['konfirmasi'] === 'ya') {
        
        try {
            if ($castManager->delete((int)$id)) {
                header("Location: ?page=cast");
                exit;
            } else {
                $error_message = "Gagal menghapus Cast. Silakan coba lagi.";
            }
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                $error_message = "Tidak dapat menghapus Cast ini karena masih terhubung dengan K-Drama lain. Silakan ubah relasi K-Drama pada Cast ini terlebih dahulu.";
            } else {
                $error_message = "Terjadi kesalahan database tak terduga: " . htmlspecialchars($e->getMessage());
            }
        }
    }

    header("Location: ?page=cast");
    exit;
}
?>

<h2>Hapus Cast (Pemain)</h2>

<?php if ($error_message): ?>
    <p style='color:red;'><?= htmlspecialchars($error_message) ?></p>
    <p><a href="?page=cast">Kembali ke Daftar Cast</a></p>
<?php elseif ($cast_data): ?>
    <p>Apakah kamu yakin ingin menghapus data "<?= htmlspecialchars($cast_data['nama']) ?>" dari daftar Cast?</p>

    <form method="POST">
        <input type="hidden" name="id" value="<?= (int)$id ?>"> 
        
        <button type="submit" name="konfirmasi" value="ya">Ya, Hapus</button>
        <button type="submit" name="konfirmasi" value="tidak">Tidak</button> 
        </form>
<?php else: ?>
    <p style='color:red;'>Data Cast tidak dapat diproses. Kembali ke daftar Cast.</p>
    <p><a href="?page=cast">Kembali ke Daftar Cast</a></p>
<?php endif; ?>