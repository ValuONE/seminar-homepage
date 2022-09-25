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
        $showEdit = null;

        $this->contentHandler->ensureSession();

        if (isset($_GET['id'])) {
            $id = @(int) ($_GET['id'] ?? '');

            if (!empty($id)) {
                $data = $this->contentHandler->fetchBlogById($id);
            }
        }

        if (isset($_POST['edit'])) {
            $id = @(int) ($_POST['id'] ?? '');
            $title = @(string) ($_POST['title'] ?? '');
            $content = @(string) ($_POST['content'] ?? '');

            if (!empty($id) && !empty($title) && !empty($content)) {
                $result = $this->contentHandler->checkBlogById($id, $_SESSION['username']);

                if ($result) {
                    $result = $this->contentHandler->updateBlog($id, $title, $content);

                    if (!$result) {
                        $showEdit = true;
                    }
                }
            } else {
                $showEdit = true;
            }
            $data = $this->contentHandler->fetchBlogById($id);
        }

        if (isset($_POST['delete'])) {
            $id = @(int) ($_POST['id'] ?? '');

            if (!empty($id)) {
                $result = $this->contentHandler->checkBlogById($id, $_SESSION['username']);

                if ($result) {
                    $result = $this->contentHandler->deleteBlogById($id);

                    if ($result) {
                        header('Location: ./?route=blog');
                        die();
                    } else {
                        $data = $this->contentHandler->fetchBlogById($id);
                    }
                }
            }
        }

        $this->renderUser('pages/view',  'view.main.css', [
            'data' => $data,
            'showEdit' => $showEdit
        ]);
    }
}