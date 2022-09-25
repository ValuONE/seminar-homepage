<?php
/*
 * Copyright (c) 2022 by Valu. All rights reserved
 *
 * @author Valu
 */

namespace Valu\App\Controller\User;

use Valu\App\Controller\AbstractController;
use Valu\App\Support\Authentication\AuthService;

class UserVerifyController extends AbstractController
{
    public function __construct(protected AuthService $authService) {}

    public function verify(): void
    {
        $error = null;
        $notMatching = null;

        if (isset($_POST['change'])) {
            $username = @(string) ($_POST['username'] ?? '');
            $password = @(string) ($_POST['password'] ?? '');
            $password2 = @(string) ($_POST['password2'] ?? '');
            $id = @(int) ($_POST['id'] ?? '');

            if (!empty($username) && !empty($password) && !empty($password2) && !empty($id)) {
                $validate = $this->authService->validateUserById($id, $username);

                if ($validate) {
                    if ($password === $password2) {
                        $result = $this->authService->verify($username, $password);

                        if ($result) {
                            header('Location: ./?route=blog');
                            die();
                        }
                        $error = true;
                    }
                }
            }
        }

        $this->renderUser('pages/verify',  'verify.main.css', [
            'error' => $error,
            'notMatching' => $notMatching
        ]);
    }
}