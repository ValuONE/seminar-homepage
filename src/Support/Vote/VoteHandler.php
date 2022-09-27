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

    public function addItem(array $file, string $username): bool
    {
        if ($this->fetchAllOfUser($username) !== null) return false;

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

            $fileNameNew = "blog" . "_" . uniqid() . "." . $fileActualExt;

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

    public function fetchAllOfUser(string $username): ?array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM `images` WHERE `author` = :author');
        $stmt->bindValue('author', $username);
        $success = $stmt->execute();

        if (!$success) return null;

        $rowCount = $stmt->rowCount();

        if ($rowCount !== 5) return null;

        return $stmt->fetchAll();
    }

}