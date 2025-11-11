<?php
require_once __DIR__ . '/../class/Kdramas.php';
require_once __DIR__ . '/../class/Platforms.php'; 

$kdramaManager = new Kdramas();
$platformManager = new Platforms();
$platforms = $platformManager->getAll(); 

$error_message = '';

$id = $_GET['id'] ?? null;
if (!$id || !is_numeric($id)) {
    header("Location: ?page=kdramas");
    exit;
}

// Ambil data lama
$data = $kdramaManager->getById((int)$id);
if (!$data) {
    echo "<p style='color:red;'>Data K-Drama tidak ditemukan!</p>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = $_POST['judul'] ?? '';
    $genre = $_POST['genre'] ?? '';
    $tahun_liris = $_POST['tahun_liris'] ?? null;
    $id_platforms = $_POST['id_platforms'] ?? null;
    
    if (empty($judul) || empty($genre) || empty($tahun_liris)) {
        $error_message = "Judul, Genre, dan Tahun Rilis wajib diisi!";
    } else {
        // Panggil method update
        if ($kdramaManager->update($id, $judul, $genre, $tahun_liris, $id_platforms)) {
            header("Location: ?page=kdramas");
            exit;
        } else {
            $error_message = "Gagal mengedit data K-Drama!";
            // Ambil ulang data untuk mengisi form jika gagal update
            $data = $kdramaManager->getById((int)$id); 
        }
    }
}
?>

<h2>Edit K-Drama: <?= htmlspecialchars($data['judul']) ?></h2>

<?php if ($error_message): ?>
    <p style='color:red;'><?= htmlspecialchars($error_message) ?></p>
<?php endif; ?>

<form method="POST">
    <label>Judul:</label><br>
    <input type="text" name="judul" value="<?= htmlspecialchars($data['judul']) ?>" required><br><br>

    <label>Genre:</label><br>
    <input type="text" name="genre" value="<?= htmlspecialchars($data['genre']) ?>" required><br><br>

    <label>Tahun Rilis:</label><br>
    <input type="number" name="tahun_liris" min="1950" max="<?= date('Y') + 1 ?>" value="<?= htmlspecialchars($data['tahun_liris']) ?>" required><br><br> 

    <label>Platform:</label><br>
    <select name="id_platforms">
        <option value="">-- Pilih Platform (Opsional) --</option>
        <?php foreach ($platforms as $platform): ?>
            <option value="<?= (int)$platform['id'] ?>"
                <?= ((int)$platform['id'] === (int)($data['id_platforms'] ?? 0)) ? 'selected' : '' ?>>
                <?= htmlspecialchars($platform['nama']) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <button type="submit">Update</button>
    <a href="?page=kdramas">Batal</a>
</form>