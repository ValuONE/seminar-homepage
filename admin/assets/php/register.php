<?php

require '../../../Database.php';
$db = new db();

if (isset($_POST['submit'])) {
    $data = $db->fetchWhere('SELECT * FROM users WHERE username = :username', [
        'username' => $_POST['username']
    ]);

    if (!$data) {
        $stmt = $db->executeQueryWhere('INSERT INTO users (username, password, created_at, verified_at) VALUES (:username, :password, :created_at, :verified_at)', [
            'username' => $_POST['username'],
            'password' => password_hash($_POST['password'], PASSWORD_BCRYPT),
            'created_at' => date('H:i j.n.Y'),
            'verified_at' => false
        ]);
        if ($stmt) {
            // User angelegt
            header('Location: ../../register.html?stmt=suceed');
        } else {
            // STMT fehlgeschlagen
            header('Location: ../../register.html?stmt=failed');
        }
    } else {
        // Ein User mit diesem Username existiert bereits!
        echo 'User already existing';
    }
}
