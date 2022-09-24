<?php
/*
 * Copyright (c) 2022 by Valu. All rights reserved
 *
 * @author Valu
 */

namespace Valu\App\Controller\User;

use Valu\App\Controller\AbstractController;
use Valu\App\Support\Content\ContentHandler;

class UserBlogController extends AbstractController
{
    public function __construct(protected ContentHandler $contentHandler) {}

    public function blog()
    {
        $this->contentHandler->ensureSession();

        $data = $this->contentHandler->fetchAll();

        $this->renderUser('pages/blog', [
            'data' => $data
        ]);
    }

}