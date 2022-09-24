<?php
/*
 * Copyright (c) 2022 by Valu. All rights reserved
 *
 * @author Valu
 */
?>

<form class="add-section" method="post" action="./?route=add" enctype="multipart/form-data">
    <h3 class="add-header">Blog hinzufügen</h3>

    <label>
        <input type="text" name="title" placeholder="Titel" required>
    </label>

    <label for="myTextarea">
        <textarea id="myTextarea" name="content" placeholder="Hier kannst du bis zu 5000 Zeichen Text schreiben!" maxlength="5000"></textarea>
    </label>

    <input type="file" name="file" required>
    <input type="submit" name="submit" value="Hinzufügen">

    <?php if (isset($error)): ?>
        <p class="warning">Es ist ein Fehler aufgetreten</p>
    <?php endif; ?>
</form>
