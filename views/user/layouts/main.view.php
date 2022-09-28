<?php
/*
 * Copyright (c) 2022 by Valu. All rights reserved
 *
 * @author Valu
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../../assets/css/user.main.css">
    <link rel="stylesheet" href="../../../assets/css/<?php echo e($style)?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
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
                    <li class="nav__item"><a href="./index.php?route=home"><i class="fa-solid fa-house"></i> Home</a></li>
                    <li class="nav__item"><a href="./index.php?route=blog"><i class="fa-solid fa-square-rss"></i> Blog</a></li>
                    <?php if (isset($_SESSION['username'])): ?>
                        <li class="nav__item"><a href="./index.php?route=vote"><i class="fas fa-vote-yea"></i> Vote</a></li>
                        <li class="nav__item"><a href="./index.php?route=logout"><i class="fa-solid fa-circle-xmark"></i> Logout</a></li>
                    <?php else: ?>
                        <li class="nav__item"><a href="./index.php?route=login"><i class="fa-solid fa-right-to-bracket"></i> Log-in</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
            <a href="#" class="brand">Murnauer Moos</a>
            <a href="https://www.instagram.com/murnauer_moos_sgm/" target="_blank" class="button button--icon">
                <i class="fa-brands fa-instagram"></i><span>⠀⠀⠀</span>
            </a>
        </div>
    </header>
    <?php if (!empty($content)) echo $content; ?>
    <script src="../../../assets/js/menu.js"></script>
    <script src="../../../assets/js/slider.js"></script>
    <script src="../../../assets/js/preview.js"></script>
</body>
</html>