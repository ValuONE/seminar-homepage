<?php
/*
 * Copyright (c) 2022 by Valu. All rights reserved
 *
 * @author Valu
 */

if (isset($images) && !isset($_POST['startVote']) && !isset($showVote) && isset($showRanking) && !$showRanking): ?>

    <h2 class="myPicture-title">Alle meine hochgeladenen Bilder:</h2>

    <hr>

    <div class="gallery">

        <?php foreach ($images as $image): ?>

            <img src="../../../assets/uploads_vote/<?php echo e($image['filename']); ?>" alt="">

        <?php endforeach; ?>

    </div>

    <hr>

    <div class="vote-section">
        <h3 class="vote-title">Das Voting startet in: <span id="clock"></span></h3>

        <form method="post" action="./?route=vote">
            <?php // TODO: "disabled" wieder einfügen! ?>
            <input class="vote-button" type="submit" name="startVote" value="Abstimmen">
        </form>
    </div>

<?php elseif(isset($showRanking) && $showRanking): ?>

    <h3 class="title">Das Ergebnis wird bald gezeigt!</h3>

<?php elseif(isset($_POST['startVote']) || isset($showVote)): ?>

    <?php if (isset($error) && isset($votes)): ?>
        <h3 class="warning">Es müssen genau <?php echo e($votes); ?> Bilder ausgewählt werden</h3>
    <?php endif; ?>

    <?php if (isset($votes)): ?>
        <h3 class="title">Du kannst nun abstimmen! Jeder hat <?php echo e($votes); ?> Stimmen und die Entscheidung kann nicht geändert werden.</h3>
    <?php endif; ?>

    <?php if (isset($allImg)): ?>

        <form method="post" action="./?route=vote">

            <div class="confirm-button-container">
                <button type="submit" name="confirm" class="confirm-button" id="btn">6 Übrig</button>
            </div>

            <div class="container">

                <?php foreach ($allImg as $img): ?>

                    <div class="container-item">
                        <img data-enlargeable src="../../../assets/uploads_vote/<?php echo $img['filename'];?>" alt="Vollbild" id="myImg">
                        <div class="container-checkbox">
                            <label>
                                Auswählen
                                <input class="check" type="checkbox" name="<?php echo e($img['id']); ?>">
                            </label>
                        </div>
                    </div>

                <?php endforeach; ?>

                <script>
                    const votesString = "<?=$votes?>";
                    const votes = parseInt(votesString);
                    const button = document.getElementById("btn");

                    $(document).ready(function() {
                        $('.check').click(function() {
                            const checkboxes = $('input:checkbox:checked').length;

                            if (checkboxes < votes) {
                                const left = (votes - checkboxes);
                                button.style.cursor = "pointer";
                                button.disabled = false;
                                button.textContent = left + " Übrig";
                            } else if(checkboxes === votes) {
                                button.style.cursor = "pointer";
                                button.disabled = false;
                                button.textContent = "Abstimmen";
                            } else if(checkboxes > votes) {
                                const over = checkboxes - votes;
                                button.style.cursor = "not-allowed";
                                button.disabled = true;
                                button.textContent = over + " Zuviel";
                            } else if (checkboxes === 0) {
                                button.style.cursor = "pointer";
                                button.disabled = false;
                                button.textContent = "6 Übrig";
                            }
                        })
                    });
                </script>

            </div>

        </form>

        <script src="../../../assets/js/view.js"></script>

    <?php endif; ?>

<?php else: ?>

    <?php if (isset($error)): ?>
        <h3 class="warning">Es ist ein Fehler aufgetreten</h3>
    <?php endif; ?>

    <div class="add-section">

        <form method="post" action="./?route=vote" enctype="multipart/form-data">

            <h4 class="add-header">Uploade deine 5 besten Bilder</h4>

            <div class="img-container">
                <input class="input" id="gallery-photo-add" type="file" name="file[]" multiple><br>
            </div>

            <label class="checkbox">
                Alle Bilder sind meine eigenen:
                <input type="checkbox" name="agree" required><br>
            </label>

            <input class="input submit" type="submit" name="upload" value="Hochladen">

        </form>

    </div>

    <p class="preview-desc">Bildervorschau</p>

    <div class="gallery"></div>

    <script src="../../../assets/js/limiter.js"></script>
    <script src="../../../assets/js/preview.js"></script>

    <hr>

    <div class="vote-section">
        <h3 class="vote-title">Das Voting startet in: <span id="clock"></span></h3>

        <form method="post" action="./?route=vote">
            <?php // TODO: "disabled" wieder einfügen! ?>
            <input class="vote-button" type="submit" name="startVote" value="Abstimmen">
        </form>
    </div>

<?php endif; ?>

<script src="../../../assets/js/clock.js"></script>
