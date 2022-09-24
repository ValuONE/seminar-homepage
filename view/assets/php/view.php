<?php
/*
 * Copyright (c) 2022 by Valu. All rights reserved
 *
 * @author Valu
 */

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../login/login.php");
    exit;
}

require '../../../Database.php';
$db = new db();

if (isset($_POST['edit'])) {
    $title = @(string) ($_POST['title'] ?? '');
    $content = @(string) ($_POST['content'] ?? '');
    $id = @(string) ($_POST['id'] ?? '');

    if (!empty($title) && !empty($content) && !empty($id)) {
        $result = $db->executeQueryWhere('UPDATE `blog` SET `title` = :title, `content` = :content WHERE `bid` = :id', [
            'title' => $title,
            'content' => $content,
            'id' => $id
        ]);

        if ($result) {
            header('Location: ../../view.php?id=' . $id);
            die();
        }
    }

    header('Location: ../../view.php?id=' . $id . '&error=true');
    die();
}

if (isset($_POST['delete'])) {
    $id = @(int) ($_POST['id'] ?? '');

    if (!empty($id)) {
        $result = $db->executeQueryWhere('DELETE FROM `blog` WHERE `bid` = :id', [
            'id' => $id
        ]);

        if (!$result) {
            header('Location: ../../view.php?id=' . $id);
            die();
        }

        header('Location: ../../../blog/blog.php');
    }
}