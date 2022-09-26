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
use Valu\App\Controller\User\UserVoteController;
use Valu\App\Support\Authentication\AuthService;
use Valu\App\Controller\User\UserLoginController;
use Valu\App\Support\Content\ContentHandler;
use Valu\App\Support\Vote\VoteHandler;

require_once __DIR__ . '/inc/all.inc.php';

$authService = new AuthService($pdo);
$contentHandler = new ContentHandler($pdo);
$voteHandler = new VoteHandler($pdo);
$userLoginController = new UserLoginController($authService);
$userVerifyController = new UserVerifyController($authService);
$userAddController = new UserAddController($contentHandler);
$userBlogController = new UserBlogController($contentHandler);
$userViewController = new UserViewController($contentHandler);
$userHomeController = new UserHomeController($contentHandler);
$userVoteController = new UserVoteController($voteHandler);

$route = @(string) ($_GET['route'] ?? 'vote');

switch ($route) {
    case ('home'): {
        $userHomeController->home();
        break;
    }
    case ('blog'): {
        $userBlogController->blog();
        break;
    }
    case ('vote'): {
        $userVoteController->vote();
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