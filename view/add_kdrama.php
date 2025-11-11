<?php
require_once __DIR__ . '/../class/Kdramas.php';
require_once __DIR__ . '/../class/Platforms.php'; // <-- Diperlukan untuk dropdown Platform

$kdramaManager = new Kdramas();
$platformManager = new Platforms();
$platforms = $platformManager->getAll(); // <-- Asumsi Platform::getAll() ada

$success_message = '';
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = $_POST['judul'] ?? '';
    $genre = $_POST['genre'] ?? '';
    $tahun_liris = $_POST['tahun_liris'] ?? null;
    $id_platforms = $_POST['id_platforms'] ?? null;
    
    // Validasi dasar
    if (empty($judul) || empty($genre) || empty($tahun_liris)) {
        $error_message = "Judul, Genre, dan Tahun Rilis wajib diisi!";
    } else {
        if ($kdramaManager->create($judul, $genre, $tahun_liris, $id_platforms)) {
            // Redireksi setelah sukses
            header("Location: ?page=kdramas");
            exit;
        } else {
            $error_message = "Gagal menambahkan K-Drama! Terjadi kesalahan database.";
        }
    }
}
?>

<h2>Tambah K-Drama Baru</h2>

<?php if ($error_message): ?>
    <p style='color:red;'><?= htmlspecialchars($error_message) ?></p>
<?php endif; ?>

<form method="POST">
    <label>Judul:</label><br>
    <input type="text" name="judul" required><br><br>

    <label>Genre:</label><br>
    <input type="text" name="genre" required><br><br>

    <label>Tahun Rilis:</label><br>
    <input type="number" name="tahun_liris" min="1950" max="<?= date('Y') + 1 ?>" required><br><br> 

    <label>Platform:</label><br>
    <select name="id_platforms">
        <option value="">-- Pilih Platform (Opsional) --</option>
        <?php foreach ($platforms as $platform): ?>
            <option value="<?= (int)$platform['id'] ?>">
                <?= htmlspecialchars($platform['nama']) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <button type="submit">Simpan</button>
    <a href="?page=kdramas">Batal</a>
</form>