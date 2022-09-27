<?php
/*
 * Copyright (c) 2022 by Valu. All rights reserved
 *
 * @author Valu
 */

if (isset($images)): ?>

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
            <input class="vote-button" type="submit" name="startVote" value="Abstimmen" disabled>
        </form>
    </div>

<?php elseif(isset($_POST['startVote']) || isset($showVote)): ?>

    <h3>das Voting</h3>

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

    <hr>

    <div class="vote-section">
        <h3 class="vote-title">Das Voting startet in: <span id="clock"></span></h3>

        <form method="post" action="./?route=vote">
            <input class="vote-button" type="submit" name="startVote" value="Abstimmen" disabled>
        </form>
    </div>

<?php endif; ?>

<script src="../../../assets/js/clock.js"></script>
