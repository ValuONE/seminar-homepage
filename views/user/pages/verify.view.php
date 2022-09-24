<?php
/*
 * Copyright (c) 2022 by Valu. All rights reserved
 *
 * @author Valu
 */
?>

<form class="change-section" method="post" action="./?route=verify">
    <h3 class="change-header">Passwort ändern</h3>
    <input type="hidden" name="id" value="<?php echo $_SESSION['userId'];?>">
    <label>
        <input type="text" name="username" value="<?php echo $_SESSION['username'];?>" readonly>
    </label>
    <label>
        <input type="password" name="password" placeholder="Passwort" required>
    </label>
    <label>
        <input type="password" name="password2" placeholder="Passwort bestätigen" required>
    </label>
    <input type="submit" name="change" value="Passwort ändern">

    <?php
    if (isset($error)) {
        echo '<p class="warning">Es ist ein Fehler aufgetreten</p>';
    } elseif (isset($notMatching)) {
        echo '<p class="warning">Passwörter stimmen nicht überein</p>';
    }
    ?>
</form>
