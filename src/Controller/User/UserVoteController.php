<?php
/*
 * Copyright (c) 2022 by Valu. All rights reserved
 *
 * @author Valu
 */

namespace Valu\App\Controller\User;

use Valu\App\Controller\AbstractController;
use Valu\App\Support\Vote\VoteHandler;

class UserVoteController extends AbstractController
{
    public function __construct(protected VoteHandler $voteHandler) {}

    public function vote(): void
    {
        $this->renderUser('pages/vote', 'vote.main.css', []);
    }
}