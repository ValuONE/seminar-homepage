<?php
/*
 * Copyright (c) 2022 by Valu. All rights reserved
 *
 * @author Valu
 */

namespace Valu\App\Support\Vote;

use PDO;

class VoteHandler
{
    public function __construct(protected PDO $pdo) {}


}