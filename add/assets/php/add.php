<?php

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login/login.php");
    exit;
}

require '../../../Database.php';
$db = new db();

if(isset($_POST['submit'])) {

    $files = $_FILES['file'];

    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode(".", $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png');

    if ($fileError !== 0) {
        header('Location: ../../add.php?error=damaged');
        die();
    }

    if (!in_array($fileActualExt, $allowed)) {
        header('Location: ../../add.php?error=file_wrong');
        die();
    }

    if ($fileSize > 157286400) {
        header('Location: ../../add.php?error=too_big');
        die();
    }

    $fileNameNew = "blog" . "_" . uniqid() . "." . $fileActualExt;

    $fileDest = 'files/' . $fileNameNew;

    move_uploaded_file($fileTmpName, $fileDest);

    $success = $db->executeQueryWhere('INSERT INTO blog (title, content, author, created_at, filename) VALUES (:title, :content, :author, :created_at, :filename)', [
        'title' => $_POST['title'],
        'content' => $_POST['content'],
        'author' => $_SESSION['username'],
        'created_at' => date('H:i j.n.Y'),
        'filename' => $fileNameNew
    ]);

    if (!$success) {
        header('Location: ../../add.php?error=stmt_failed');
        die();
    }

    header('Location: ../../../blog/blog.php?stmt=suceed');
}