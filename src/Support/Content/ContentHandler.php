<?php
/*
 * Copyright (c) 2022 by Valu. All rights reserved
 *
 * @author Valu
 */

namespace Valu\App\Support\Content;

use PDO;

class ContentHandler
{
    public function __construct(protected PDO $pdo) {}


}