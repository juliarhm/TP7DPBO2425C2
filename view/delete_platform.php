<?php
require_once __DIR__ . '/../class/Platforms.php';
$platform = new Platforms();

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: ?page=platforms");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['konfirmasi'] === 'ya') {
        $platform->delete($id);
    }
    header("Location: ?page=platforms");
    exit;
}
?>

<h2>Hapus Platform</h2>
<p>Apakah kamu yakin ingin menghapus platform ini?</p>

<form method="POST">
    <button type="submit" name="konfirmasi" value="ya">Ya, Hapus</button>
    <button type="submit" name="konfirmasi" value="tidak">Tidak</button>
</form>
