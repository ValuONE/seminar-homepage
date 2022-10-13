<?php
/*
 * Copyright (c) 2022 by Valu. All rights reserved
 *
 * @author Valu
 */

namespace Valu\App\Support\Vote;

use PDO;

class VoteHandler
{
    public function __construct(protected PDO $pdo) {}

    public function addItem(array $file, string $username, bool $enable): bool
    {
        if ($enable) {
            if ($this->fetchAllOfUser($username) !== null) return false;
        }

        $count = count($_FILES['file']['name']);

        for($i = 0; $i < $count; $i++){
            $fileName = $file['name'][$i];
            $fileTmpName = $file['tmp_name'][$i];
            $fileSize = $file['size'][$i];
            $fileError = $file['error'][$i];

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

            $fileNameNew = "vote" . "_" . uniqid() . "." . $fileActualExt;

            $fileDest = __DIR__ . '/../../../assets/uploads_vote/' . $fileNameNew;

            move_uploaded_file($fileTmpName, $fileDest);

            $stmt = $this->pdo->prepare('INSERT INTO `images` (`author`, `filename`) VALUES (:author, :filename)');
            $stmt->bindValue('author', $username);
            $stmt->bindValue('filename', $fileNameNew);
            $success = $stmt->execute();

            if (!$success) return false;
        }

        return true;
    }

    public function handleVote(array $post, string $username): void
    {
        $result = $this->canVote($username);
        if ($result) return;

        $min = $this->getLimit('ASC');
        $max = $this->getLimit('DESC');

        for($i = $min['id']; $i < $max['id']; $i++) {
            if (isset($post[$i]) && $post[$i] === 'on') {
                $this->createLike($i, $username);
                $this->updateLike($i);
            }
        }
        
        $this->disableVote($username);
    }

    public function fetchAllOfUser(string $username): ?array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM `images` WHERE `author` = :author');
        $stmt->bindValue('author', $username);
        $success = $stmt->execute();

        if (!$success) return null;

        $rowCount = $stmt->rowCount();

        if (!$rowCount >= 5) return null;

        return $stmt->fetchAll();
    }

    public function fetchAll(): bool|array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM `images`');
        $success = $stmt->execute();
        if (!$success) return false;

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLimit(string $param): ?array
    {
        $stmt = $this->pdo->prepare('SELECT `id` FROM `images` ORDER BY `id` ' . $param . ' LIMIT 1;');
        $success = $stmt->execute();
        if (!$success) return null;

        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt->fetch();
    }

    private function createLike(int $id, string $username): void
    {
        $stmt = $this->pdo->prepare('INSERT INTO `likes` (`image_id`, `voted_by`, `voted_at`) VALUES (:image_id, :voted_by, :voted_at)');
        $stmt->bindValue('image_id', $id);
        $stmt->bindValue('voted_by', $username);
        $stmt->bindValue('voted_at', time());
        $stmt->execute();
    }

    private function updateLike(int $id): void
    {
        $stmt = $this->pdo->prepare('UPDATE `images` SET `likes` = `likes` + 1 WHERE `id`= :id');
        $stmt->bindValue('id', $id);
        $stmt->execute();
    }

    public function canVote(string $username): bool
    {
        $stmt = $this->pdo->prepare('SELECT `voted` FROM `users` WHERE `username` = :username');
        $stmt->bindValue('username', $username);
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $data = $stmt->fetch();

        return $data['voted'];
    }

    private function disableVote(string $username): void
    {
        $stmt = $this->pdo->prepare('UPDATE `users` SET `voted` = 1 WHERE `username` = :username');
        $stmt->bindValue('username', $username);
        $stmt->execute();
    }

    public function ensureSession(): void
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
    }
}