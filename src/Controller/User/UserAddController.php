<?php
/*
 * Copyright (c) 2022 by Valu. All rights reserved
 *
 * @author Valu
 */

namespace Valu\App\Controller\User;

use Valu\App\Controller\AbstractController;
use Valu\App\Support\Content\ContentHandler;

class UserAddController extends AbstractController
{
    public function __construct(protected ContentHandler $contentHandler) {}

    public function add()
    {
        $error = null;

        if (!empty($_POST)) {
            $title = @(string) ($_POST['title'] ?? '');
            $content = @(string) ($_POST['content'] ?? '');
            $file = ($_FILES['file'] ?? '');

            if (!empty($title) && !empty($content) && !empty($file)) {
                $result = $this->contentHandler->addBlog($title, $content, $file);

                if ($result) {
                    header('Location: ./?route=blog');
                    die();
                } else {
                    $error = true;
                }
            } else {
                $error = true;
            }
        }

        $this->renderUser('pages/add', [
            'error' => $error
        ]);
    }

}