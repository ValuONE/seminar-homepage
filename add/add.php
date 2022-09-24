<?php

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login/login.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Blog hinzufügen</title>
</head>
<body>
    <header class="site-header">
        <div class="wrapper site-header__wrapper">
            <nav class="nav">
                <button class="nav__toggle" aria-expanded="false" type="button">
                    <i class="fa-solid fa-bars"></i> Menu
                </button>
                <ul class="nav__wrapper">
                    <li class="nav__item"><a href="../index.html"><i class="fa-solid fa-house"></i> Home</a></li>
                    <li class="nav__item"><a href="../blog/blog.php"><i class="fa-solid fa-square-rss"></i> Blog</a></li>
                    <li class="nav__item"><a href="../login/login.php"><i class="fa-solid fa-right-to-bracket"></i> Log-in</a></li>
                </ul>
            </nav>
            <a href="#" class="brand">Murnauer Moos</a>
            <a href="https://www.instagram.com/murnauer_moos_sgm/" target="_blank" class="button button--icon">
                <i class="fa-brands fa-instagram"></i><span>⠀⠀⠀</span>
            </a>
        </div>
    </header>
    <form class="add-section" method="post" action="assets/php/add.php" enctype="multipart/form-data">
        <h3 class="add-header">Blog hinzufügen</h3>
        <label>
            <input type="text" name="title" placeholder="Titel" required>
        </label>
        <label for="myTextarea">
            <textarea id="myTextarea" name="content" placeholder="Hier kannst du bis zu 5000 Zeichen Text schreiben!" maxlength="5000"></textarea>
        </label>
        <input type="file" name="file" required>
        <input type="submit" name="submit" value="Hinzufügen">
        <?php
            if (isset($_GET['error'])) {
                switch ($_GET['error']) {
                    case ('stmt_failed'):
                        echo '<p class="warning">Datenbank-Fehler!</p>';
                        break;
                    case ('too_big'):
                        echo '<p class="warning">Datei darf nicht größer als 150MB sein.</p>';
                        break;
                    case ('damaged'):
                        echo '<p class="warning">Die Datei ist beschädigt.</p>';
                        break;
                    case ('file_wrong'):
                        echo '<p class="warning">Es die Datei muss ein jpg, jpeg oder ein png sein.</p>';
                        break;
                }
            }
        ?>
    </form>
    <script src="assets/js/menu.js"></script>
</body>
</html>