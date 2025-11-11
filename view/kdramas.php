<?php
require_once __DIR__ . '/../class/Kdramas.php';
$kdrama = new Kdramas();
$data = $kdrama->getAll();
?>
<h2>Daftar K-Drama</h2>
<a href="?page=add_kdrama">ADD</a>

<table border="1">
    <tr>
        <th>Judul</th>
        <th>Genre</th>
        <th>Platform</th>
        <th>Aksi</th>
    </tr>
    <?php foreach ($data as $row) { ?>
        <tr>
            <td><?= htmlspecialchars($row['judul']) ?></td>
            <td><?= htmlspecialchars($row['genre']) ?></td>
            <td><?= htmlspecialchars($row['platform_name']) ?></td>
            <td class="table-actions">
                <a href="?page=edit_kdrama&id=<?= $row['id'] ?>" class="update-link">UPDATE</a>
                <a href="?page=delete_kdrama&id=<?= $row['id'] ?>" class="delete-link">DELETE</a>
            </td>
        </tr>
    <?php } ?>
</table>