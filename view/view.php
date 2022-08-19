<?php

require '../Database.php';
$db = new db();

$data = $db->fetchWhere('SELECT * FROM blog WHERE bid = :id', [
    'id' => $_REQUEST['id']
]);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Blog hinzufügen</title>
</head>
<body>
    <button class="btn-back"><a href="../blog/blog.php">Zurück</a></button>
    <div class="container">
        <h1 class="title"><?php echo $data['title'];?></h1>
        <p class="date"><?php echo $data['created_at'];?></p>
        <p class="text"><?php echo $data['content'];?></p>
        <p class="author">Verfasst von <?php echo $data['author'];?></p>
        <img class="img" src="../add/assets/php/files/<?php echo $data['filename'];?>">
    </div>
</body>
</html>