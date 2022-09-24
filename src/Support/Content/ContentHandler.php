<?php
/*
 * Copyright (c) 2022 by Valu. All rights reserved
 *
 * @author Valu
 */

namespace Valu\App\Support\Content;

use PDO;

class ContentHandler
{
    public function __construct(protected PDO $pdo) {}

    public function fetchAll(): bool|array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM `blog`');
        $success = $stmt->execute();

        if (!$success) return false;

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addBlog(string $title, string $content, mixed $file): bool
    {
        $this->ensureSession();

        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];
        $fileType = $file['type'];

        $fileExt = explode(".", $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpg', 'jpeg', 'png');

        if ($fileError !== 0) {
            return  false;
        }

        if (!in_array($fileActualExt, $allowed)) {
            return  false;
        }

        if ($fileSize > 157286400) {
            return  false;
        }

        $fileNameNew = "blog" . "_" . uniqid() . "." . $fileActualExt;

        $fileDest = __DIR__ . '/../../../assets/uploads/' . $fileNameNew;

        move_uploaded_file($fileTmpName, $fileDest);

        $stmt = $this->pdo->prepare('INSERT INTO blog (`title`, `content`, `author`, `created_at`, `filename`) VALUES (:title, :content, :author, :created_at, :filename)');
        $stmt->bindValue('title', $title);
        $stmt->bindValue('content', $content);
        $stmt->bindValue('author', $_SESSION['username']);
        $stmt->bindValue('created_at', time());
        $stmt->bindValue('filename', $fileNameNew);
        $success = $stmt->execute();

        if (!$success) return false;

        return true;
    }

    public function fetchBlogById(int $id): bool|array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM `blog` WHERE `bid` = :bid');
        $stmt->bindValue('bid', $id);
        $success = $stmt->execute();

        if (!$success) return false;

        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt->fetch();
    }

    public function ensureSession(): void
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
    }


}