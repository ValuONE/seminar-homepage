<?php
/*
 * Copyright (c) 2022 by Valu. All rights reserved
 *
 * @author Valu
 */

use Valu\App\Controller\User\UserAddController;
use Valu\App\Controller\User\UserBlogController;
use Valu\App\Controller\User\UserHomeController;
use Valu\App\Controller\User\UserVerifyController;
use Valu\App\Controller\User\UserViewController;
use Valu\App\Support\Authentication\AuthService;
use Valu\App\Controller\User\UserLoginController;
use Valu\App\Support\Content\ContentHandler;

require_once __DIR__ . '/inc/all.inc.php';

$authService = new AuthService($pdo);
$contentHandler = new ContentHandler($pdo);
$userLoginController = new UserLoginController($authService);
$userVerifyController = new UserVerifyController($authService);
$userAddController = new UserAddController($contentHandler);
$userBlogController = new UserBlogController($contentHandler);
$userViewController = new UserViewController($contentHandler);
$userHomeController = new UserHomeController($contentHandler);

$route = @(string) ($_GET['route'] ?? 'home');

switch ($route) {
    case ('home'): {
        $userHomeController->home();
        break;
    }
    case ('blog'): {
        $userBlogController->blog();
        break;
    }
    case ('login'): {
        $userLoginController->login();
        break;
    }
    case ('verify'): {
        $authService->ensureUserLogin();
        $userVerifyController->verify();
        break;
    }
    case ('add'): {
        $userAddController->add();
        break;
    }
    case ('view'): {
        $userViewController->view();
        break;
    }
    default: {
        $userHomeController->renderError();
    }
}