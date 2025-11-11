<?php
require_once __DIR__ . '/../class/Platforms.php';
$platform = new Platforms();

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: ?page=platforms");
    exit;
}

$data = $platform->getById($id);
if (!$data) {
    echo "<p style='color:red;'>Data tidak ditemukan!</p>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['nama'];
    $negara_asal = $_POST['negara_asal'];

    if ($platform->update($id, $name, $negara_asal)) {
        header("Location: ?page=platforms");
        exit;
    } else {
        echo "<p style='color:red;'>Gagal mengedit data!</p>";
    }
}
?>

<h2>Edit Platform</h2>
<form method="POST">
    <label>Nama Platform:</label><br>
    <input type="text" name="nama" value="<?= htmlspecialchars($data['nama']) ?>" required><br><br>

    <label>Asal Negara:</label><br>
    <input type="text" name="negara_asal" value="<?= htmlspecialchars($data['negara_asal']) ?>" required><br><br>

    <button type="submit">Update</button>
    <a href="?page=platforms">Batal</a>
</form>
