<?php
require_once __DIR__ . '/../class/Cast.php';
$cast = new cast();
$data = $cast->getAll();
?>
<h2>Daftar Cast (Pemain)</h2>
<a href="?page=add_cast">ADD</a>

<table border="1" cellpadding="8">
    <tr>
        <th>Nama</th>
        <th>Jenis Kelamin</th>
        <th>Agensi</th>
        <th>Kdrama</th>
        <th>Aksi</th>
    </tr>
    <?php foreach ($data as $row) { ?>
        <tr>
            <td><?= htmlspecialchars($row['nama']) ?></td>
            <td><?= htmlspecialchars($row['jenis_kelamin']) ?></td>
            <td><?= htmlspecialchars($row['agensi']) ?></td>
            <td><?= htmlspecialchars($row['kdrama_name']) ?></td>
            <td class="table-actions">
                <a href="?page=update_cast&id=<?= $row['id'] ?>" class="update-link">UPDATE</a>
                <a href="?page=delete_cast&id=<?= $row['id'] ?>" class="delete-link">DELETE</a>
            </td>
        </tr>
    <?php
} ?>
</table>