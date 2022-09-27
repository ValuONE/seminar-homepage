<?php
/*
 * Copyright (c) 2022 by Valu. All rights reserved
 *
 * @author Valu
 */

namespace Valu\App\Controller;

abstract class AbstractController
{
    protected function renderUser($path, string $style, array $data = [], bool $layout = true): void
    {
        ob_start();
        extract($data);
        require __DIR__ . '/../../views/user/' . $path . '.view.php';
        $content = ob_get_contents();
        ob_end_clean();

        if ($layout) {
            require __DIR__ . '/../../views/user/layouts/main.view.php';
        }
    }

    protected function renderAdmin($path, array $data = []): void
    {
        ob_start();
        extract($data);
        require __DIR__ . '/../../views/admin/' . $path . '.view.php';
        $content = ob_get_contents();
        ob_end_clean();

        require __DIR__ . '/../../views/admin/layouts/main.view.php';
    }

    public function renderError(): void
    {
        ob_start();
        require __DIR__ . '/../../views/user/pages/error.view.php';
        $content = ob_get_contents();
        ob_end_clean();
        require __DIR__ . '/../../views/user/layouts/main.view.php';
    }
}