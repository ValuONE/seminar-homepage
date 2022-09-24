<?php
/*
 * Copyright (c) 2022 by Valu. All rights reserved
 *
 * @author Valu
 */

namespace Valu\App\Controller\User;

use Valu\App\Controller\AbstractController;
use Valu\App\Support\Authentication\AuthService;

class UserLoginController extends AbstractController
{
    public function __construct(protected AuthService $authService) {}

    public function login(): void
    {
        if (isset($_POST)) {
            $username = @(string) ($_POST['username'] ?? '');
            $password = @(string) ($_POST['password'] ?? '');

            if (!empty($username) && !empty($password)) {
                $result = $this->authService->handleLogin($username, $password);

                if (!$result) {
                    header('Location: ./?route=login&error=true');
                } else {
                    header('Location: ./?route=blog');
                }
            }
        }
        $this->renderUser('pages/login', []);
    }
}