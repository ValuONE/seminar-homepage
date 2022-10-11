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
        $this->voteHandler->ensureSession();

        $votes = 6;
        $showVote = null;
        $error = null;
        $allImg = null;
        $showRanking = $this->voteHandler->canVote($_SESSION['username']);
        $images = $this->voteHandler->fetchAllOfUser($_SESSION['username']);

        if(isset($_POST['upload'])) {
            $file = ($_FILES['file'] ?? '');
            $count = count($_FILES['file']['name']);

            if ($count === 5) {
                if (!empty($file)) {
                    $result = $this->voteHandler->addItem($file, $_SESSION['username']);

                    $images = $this->voteHandler->fetchAllOfUser($_SESSION['username']);

                    if (!$result) {
                        $error = true;
                    }
                }
            }
        }

        if (isset($_POST['startVote'])) {
            $allImg = $this->voteHandler->fetchAll();
        }

        if (isset($_POST['confirm'])) {
            if (sizeof($_POST) == $votes + 1) {
                $this->voteHandler->handleVote($_POST, $_SESSION['username']);
                $showRanking = $this->voteHandler->canVote($_SESSION['username']);
            } else {
                $showVote = true;
                $error = true;
                $allImg = $this->voteHandler->fetchAll();
            }
        }

        $this->renderUser('pages/vote', 'vote.main.css', [
            'error' => $error,
            'images' => $images,
            'allImg' => $allImg,
            'votes' => $votes,
            'showRanking' => $showRanking,
            'showVote' => $showVote
        ]);
    }
}