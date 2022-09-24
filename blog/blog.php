<?php

session_start();

require '../Database.php';
$db = new db();

$data = $db->fetchAllQuery('SELECT * FROM blog ORDER BY bid DESC');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Blog</title>
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
    <?php if (isset($_SESSION['username'])): ?>
        <div class="add-button-container">
            <a href="../add/add.php"><button class="add-button">Blog hinzufügen</button></a>
        </div>
    <?php endif; ?>
    <div class="container">
        <?php foreach ($data as $d) { ?>
            <div class="container-item">
                <a href="../view/view.php?id=<?php echo $d['bid'];?>">
                    <img src="../add/assets/php/files/<?php echo $d['filename'];?>" alt="Picture">
                    <h3><?php echo $d['title'];?></h3>
                    <p><?php echo $d['created_at'];?></p>
                </a>
            </div>
        <?php }?>
    </div>
<script src="assets/js/menu.js"></script>
</body>
</html>