<?php

require '../../../Database.php';
$db = new db();

if (isset($_POST['submit'])) {
    $data = $db->fetchWhere('SELECT * FROM users WHERE username = :username', [
        'username' => $_POST['username']
    ]);

    if ($data){
        if (password_verify($_POST['password'], $data['password'])){
            session_start();
            $_SESSION['username'] = $_POST['username'];
            if ($data['verified_at'] == 0)  {
                header('Location: ../../../change_pw/change.php');
            } else {
                header('Location: ../../../blog/blog.php');
            }
        } else {
            // Falsches Passwort
            header('Location: ../../login.php?info=wrong_credentials');
        }
    } else {
        // Kein User mit diesem Namen registriert
        header('Location: ../../login.php?info=wrong_credentials');
    }
}
