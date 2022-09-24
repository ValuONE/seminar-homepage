<?php
/*
 * Copyright (c) 2022 by Valu. All rights reserved
 *
 * @author Valu
 */

namespace Valu\App\Controller\User;

use Valu\App\Controller\AbstractController;
use Valu\App\Support\Content\ContentHandler;

class UserViewController extends AbstractController
{
    public function __construct(protected ContentHandler $contentHandler) {}

    public function view(): void
    {
        $data = null;

        $this->contentHandler->ensureSession();

        if (isset($_GET['id'])) {
            $id = @(int) ($_GET['id'] ?? '');

            if (!empty($id)) {
                $data = $this->contentHandler->fetchBlogById($id);
            }
        }

        $this->renderUser('pages/view', [
            'data' => $data
        ]);
    }
}