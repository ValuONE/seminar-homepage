<?php
/*
 * Copyright (c) 2022 by Valu. All rights reserved
 *
 * @author Valu
 */
?>

<form method="post" action="./?route=vote" enctype="multipart/form-data">

    <div class="img-container">
        <input id="img1" type="file" name="file[]" onchange="loadFile('img1', 'img1-preview')"><br>
        <img class="img-preview" id="img1-preview" src="#" alt="Kein Bild geladen">
    </div>

    <div class="img-container">
        <input id="img2" type="file" name="file[]"><br>
        <img class="img-preview" id="img2-preview" src="#" alt="Kein Bild geladen">
    </div>

    <div class="img-container">
        <input id="img3" type="file" name="file[]"><br>
        <img class="img-preview" id="img3-preview" src="#" alt="Kein Bild geladen">
    </div>

    <div class="img-container">
        <input id="img4" type="file" name="file[]"><br>
        <img class="img-preview" id="img4-preview" src="#" alt="Kein Bild geladen">
    </div>

    <div class="img-container">
        <input id="img5" type="file" name="file[]"><br>
        <img class="img-preview" id="img5-preview" src="#" alt="Kein Bild geladen">
    </div>

    <label>
        Ich bestätige, dass alle ausgewählten Bilder meine eigenen sind:
        <input type="checkbox" name="checkbox" required>
    </label>
    <input type="submit" name="upload">
</form>