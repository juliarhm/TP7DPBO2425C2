<?php
require_once __DIR__ . '/../class/Cast.php';
require_once __DIR__ . '/../class/Kdramas.php';

$castManager = new Cast(); 
$kdramaManager = new Kdramas();
$kdramas = $kdramaManager->getAll();

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: ?page=cast");
    exit;
}

$data = $castManager->getById($id);
if (!$data) {
    echo "<p style='color:red;'>Data tidak ditemukan!</p>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['nama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $agensi = $_POST['agensi'];
    $id_kdrama = $_POST['id_kdrama'];

    try {
        Gender::from($jenis_kelamin); 
    } catch (ValueError $e) {
        echo "<p style='color:red;'>Jenis kelamin tidak valid!</p>";
        exit;
    }

    if ($castManager->update($id, $name, $jenis_kelamin, $agensi, $id_kdrama)) {
        header("Location: ?page=cast");
        exit;
    } else {
        echo "<p style='color:red;'>Gagal mengedit data!</p>";
    }
}
?>

<h2>Edit Data Cast: <?= htmlspecialchars($data['nama']) ?></h2>
<form method="POST">

    <label>Nama:</label><br>
    <input type="text" name="nama" value="<?= htmlspecialchars($data['nama'] ?? '') ?>" required><br><br>

    <label>Jenis Kelamin:</label><br>
    <select name="jenis_kelamin" required>
        <?php foreach (Gender::cases() as $g): ?>
            <option value="<?= htmlspecialchars($g->value) ?>" 
                <?= $g->value == $data['jenis_kelamin'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($g->value) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Agensi:</label><br>
    <input type="text" name="agensi" value="<?= htmlspecialchars($data['agensi'] ?? '') ?>"><br><br>

    <label>K-Drama:</label><br>
    <select name="id_kdrama">
        <option value="">-- Pilih K-Drama (Opsional) --</option>
        <?php foreach ($kdramas as $kdrama): ?>
            <option value="<?= (int)$kdrama['id'] ?>"
                <?= (int)$kdrama['id'] === (int)($data['id_kdrama'] ?? 0) ? 'selected' : '' ?>>
                <?= htmlspecialchars($kdrama['judul']) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <button type="submit">Update</button>
    <a href="?page=cast">Batal</a>
</form>