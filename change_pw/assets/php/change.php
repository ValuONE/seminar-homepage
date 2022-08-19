<?php

require '../../../Database.php';
$db = new db();

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../../login/login.php");
    exit;
}

if (isset($_POST['submit'])) {
    $data = $db->executeQueryWhere('SELECT * FROM users WHERE username = :username', [
        'username' => $_SESSION['username']
    ]);

    if ($data) {
        if ($_POST['password'] == $_POST['password2']) {
            $stmt = $db->executeQueryWhere('UPDATE users SET password = :password, verified_at = :verified_at WHERE username = :username', [
                'username' => $_SESSION['username'],
                'verified_at' => 1,
                'password' => password_hash($_POST['password'], PASSWORD_BCRYPT)
            ]);

            if ($stmt) {
                // STMT suceed
                header('Location: ../../../add/add.php?stmt=suceed');
            } else {
                //STMT failed
                header('Location: ../../change/change.php?stmt=failed');
            }
        } else {
            // Passwörter stimmen nicht überein
            header('Location: ../../change/change.php?stmt=failed');
        }
    } else {
        // Kein User mit diesem Username
        header('Location: ../../change/change.php?stmt=failed');
    }
}
