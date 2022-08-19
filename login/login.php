<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Login</title>
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
                    <li class="nav__item"><a href="login.php"><i class="fa-solid fa-right-to-bracket"></i> Log-in</a></li>
                </ul>
            </nav>
            <a href="#" class="brand">Murnauer Moos</a>
            <a href="https://www.instagram.com/murnauer_moos_sgm/" target="_blank" class="button button--icon">
                <i class="fa-brands fa-instagram"></i><span>⠀⠀⠀</span>
            </a>
        </div>
    </header>
    <form class="login-section" method="post" action="assets/php/login.php">
        <h3 class="login-header">Login - Blogbereich</h3>
        <div class="form-container">
            <input type="text" placeholder="Benutzername" name="username" required>
            <input type="password" placeholder="Passwort" name="password" required>
            <input type="submit" value="Login" name="submit">
            <?php
                if (isset($_REQUEST['info'])) {
                    echo '<p class="warning">Benutzername oder Passwort falsch!</p>';
                }
            ?>
        </div>
    </form>
    <script src="assets/js/menu.js"></script>
</body>
</html>