<?php
require_once __DIR__ . '/../class/Platforms.php';
$platforms = new Platforms();
$data = $platforms->getAll();
?>
<h2>Daftar K-Drama</h2>
<a href="?page=add_platform">ADD</a>
<table border="1">
    <tr>
        <th>Nama</th>
        <th>Asal Negara</th>
        <th>Aksi</th>
    </tr>
    <?php foreach ($data as $row) { ?>
        <tr>
            <td><?= htmlspecialchars($row['nama']) ?></td>
            <td><?= htmlspecialchars($row['negara_asal']) ?></td>
            <td class="table-actions">
                <a href="?page=edit_platform&id=<?= $row['id'] ?>" class="update-link">UPDATE</a>
                <a href="?page=delete_platform&id=<?= $row['id'] ?>" class="delete-link">DELETE</a>
            </td>
        </tr>
    <?php } ?>
</table>