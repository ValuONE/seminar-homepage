<?php
/*
 * Copyright (c) 2022 by Valu. All rights reserved
 *
 * @author Valu
 */

namespace Valu\App\Controller\User;

use Valu\App\Controller\AbstractController;
use Valu\App\Support\Content\ContentHandler;

class UserHomeController extends AbstractController
{
    public function __construct(protected ContentHandler $contentHandler) {}

    public function home()
    {
        $this->contentHandler->ensureSession();

        $this->renderUser('pages/home', 'home.main.css');
    }

    public function error(): void
    {
        $this->contentHandler->ensureSession();

        $this->renderError();
    }
}