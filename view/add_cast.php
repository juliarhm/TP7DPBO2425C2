<?php
require_once __DIR__ . '/../class/Cast.php';
require_once __DIR__ . '/../class/Kdramas.php';

$castManager = new Cast();
$kdramaManager = new Kdramas();
$kdramas = $kdramaManager->getAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $agensi = $_POST['agensi'];
    $id_kdrama = $_POST['id_kdrama'] ? (int)$_POST['id_kdrama'] : null;

    // validasi jenis kelamin menggunakan enum
    try {
        $gender = Gender::from($jenis_kelamin);
    } catch (ValueError $e) {
        echo "<p style='color:red;'>Jenis kelamin tidak valid!</p>";
        exit;
    }

    if ($castManager->create($nama, $jenis_kelamin, $agensi, $id_kdrama)) {
        header("Location: ?page=cast");
        exit;
    } else {
        echo "<p style='color:red;'>Gagal menambahkan platform!</p>";
    }
}
?>

<h2>Tambah Cast Baru</h2>
<form method="POST">
    <label>Nama:</label><br>
    <input type="text" name="nama" required><br><br>

    <label>Jenis Kelamin:</label><br>
    <select name="jenis_kelamin" required>
        <?php foreach (Gender::cases() as $g): ?>
            <option value="<?= htmlspecialchars($g->value) ?>"><?= htmlspecialchars($g->value) ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Agensi:</label><br>
    <input type="text" name="agensi" required><br><br>

    <select name="id_kdrama">
        <option value="">-- Pilih K-Drama (Opsional) --</option>
        <?php foreach ($kdramas as $kdrama): ?>
            <option value="<?= (int)$kdrama['id'] ?>">
                <?= htmlspecialchars($kdrama['judul']) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <button type="submit">Simpan</button>
    <a href="?page=platforms">Batal</a>
</form>