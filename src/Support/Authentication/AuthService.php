<?php
/*
 * Copyright (c) 2022 by Valu. All rights reserved
 *
 * @author Valu
 */

namespace Valu\App\Support\Authentication;

use PDO;

class AuthService
{
    public function __construct(protected PDO $pdo) {}

    public function handleLogin(string $username, string $password): bool
    {
        $stmt = $this->pdo->prepare('SELECT * FROM `users` WHERE `username` = :username');
        $stmt->bindValue('username', $username);
        $success = $stmt->execute();

        if (!$success) return false;

        $rowCount = $stmt->rowCount();

        if ($rowCount != 1) return false;

        $stmt->setFetchMode(PDO::FETCH_CLASS, AuthServiceUserData::class);
        $userData = $stmt->fetch();

        if (!password_verify($password, $userData->password)) return false;

        $this->ensureSession();

        $_SESSION['username'] = $userData->username;
        $_SESSION['userId'] = $userData->uid;

        if (!$userData->verified) {
            header('Location: ./?route=verify');
            die();
        }

        return true;
    }

    public function verify(string $username, string $password): bool
    {
        $stmt = $this->pdo->prepare('UPDATE `users` SET `password` = :password, `verified` = :verified WHERE `username` = :username');
        $stmt->bindValue('password', password_hash($password, PASSWORD_BCRYPT));
        $stmt->bindValue('verified', true);
        $stmt->bindValue('username', $username);
        $success = $stmt->execute();

        if (!$success) return false;

        return true;
    }

    public function validateUserById(int $id, string $username): bool
    {
        $stmt = $this->pdo->prepare('SELECT `username` FROM `users` WHERE `uid` = :id');
        $stmt->bindValue('id', $id);
        $success = $stmt->execute();

        if (!$success) return false;

        $stmt->setFetchMode(PDO::FETCH_CLASS, AuthServiceUserData::class);
        $userData = $stmt->fetch();

        if ($userData->username !== $username) return false;

        return true;
    }

    public function ensureUserLogin(): void
    {
        $this->ensureSession();

        if (!isset($_SESSION['username'])) header('Location: ./?route=login');
    }

    private function ensureSession(): void
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
    }
}