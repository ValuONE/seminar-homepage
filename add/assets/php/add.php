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

    if(in_array($fileActualExt, $allowed)){
        if($fileError === 0){
            if($fileSize < 157286400){

                $fileNameNew = "blog"."_".uniqid().".".$fileActualExt;

                $fileDest = 'files/'.$fileNameNew;

                move_uploaded_file($fileTmpName, $fileDest);

                $data = $db->executeQueryWhere('INSERT INTO blog (title, content, author, created_at, filename) VALUES (:title, :content, :author, :created_at, :filename)', [
                    'title' => $_POST['title'],
                    'content' => $_POST['content'],
                    'author' => $_SESSION['username'],
                    'created_at' => date('H:i j.n.Y'),
                    'filename' => $fileNameNew
                ]);



                if ($data) {
                    // Blog added
                    header('Location: ../../../blog/blog.php?stmt=suceed');
                } else {
                    // Query failed
                    header('Location: ../../add.php?info=stmt_failed');
                }

            } else {
                // Too big
                header('Location: ../../add.php?size=too_big');
            }
        } else {
            // Corrupted file
            header('Location: ../../add.php?file=damaged');
        }
    } else {
        // Wrong file type
        header('Location: ../../add.php?type=file_wrong');
    }
}






