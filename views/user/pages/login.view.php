<?php
/*
 * Copyright (c) 2022 by Valu. All rights reserved
 *
 * @author Valu
 */
?>

<form class="login-section" method="post" action="./?route=login">
    <h3 class="login-header">Login - Blogbereich</h3>
    <div class="form-container">
        <label>
            <input type="text" placeholder="Benutzername" name="username" required>
        </label>
        <label>
            <input type="password" placeholder="Passwort" name="password" required>
        </label>
        <input type="submit" value="Login" name="submit">
        <?php
            if (isset($_GET['error'])) {
                echo '<p class="warning">Benutzername oder Passwort falsch!</p>';
            }
        ?>
    </div>
</form>