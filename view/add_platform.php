<?php
require_once __DIR__ . '/../class/Platforms.php';
$platform = new Platforms();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $asal_negara = $_POST['asal_negara'];

    if ($platform->create($nama, $asal_negara)) {
        header("Location: ?page=platforms");
        exit;
    } else {
        echo "<p style='color:red;'>Gagal menambahkan platform!</p>";
    }
}
?>

<h2>Tambah Platform Baru</h2>
<form method="POST">
    <label>Nama Platform:</label><br>
    <input type="text" name="nama" required><br><br>

    <label>Asal Negara:</label><br>
    <input type="text" name="asal_negara" required><br><br>

    <button type="submit">Simpan</button>
    <a href="?page=platforms">Batal</a>
</form>