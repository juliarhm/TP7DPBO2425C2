<?php
require_once 'class/Cast.php';
require_once 'class/Kdramas.php';
require_once 'class/Platforms.php';

$cast = new Cast();
$kdrama = new Kdramas();
$platforms = new Platforms();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>K-Drama Library System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'view/header.php'; ?>

    <main>
        <h2>Welcome to List K-Drama</h2>
        <nav>
            <a href="?page=cast">Cast</a> |
            <a href="?page=kdramas">K-Drama</a> |
            <a href="?page=platforms">Platforms</a>
        </nav>

        <?php
        if (isset($_GET['page'])) {
            $page = $_GET['page'];

            if ($page == 'cast') include 'view/cast.php';
            elseif ($page == 'add_cast') include 'view/add_cast.php';
            elseif ($page == 'update_cast') include 'view/update_cast.php';
            elseif ($page == 'delete_cast') include 'view/delete_cast.php';

            elseif ($page == 'kdramas') include 'view/kdramas.php';
            elseif ($page == 'add_kdrama') include 'view/add_kdrama.php';
            elseif ($page == 'edit_kdrama') include 'view/edit_kdrama.php';
            elseif ($page == 'delete_kdrama') include 'view/delete_kdrama.php';

            elseif ($page == 'platforms') include 'view/platforms.php';
            elseif ($page == 'add_platform') include 'view/add_platform.php';
            elseif ($page == 'edit_platform') include 'view/edit_platform.php';
            elseif ($page == 'delete_platform') include 'view/delete_platform.php';

            else echo "<p>Halaman tidak ditemukan.</p>";
        } else {
            echo "<p>Silakan pilih menu di atas untuk memulai.</p>";
        }
        ?>
    </main>

    <?php include 'view/footer.php'; ?>
</body>
</html>