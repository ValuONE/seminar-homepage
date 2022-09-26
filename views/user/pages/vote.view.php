<?php
/*
 * Copyright (c) 2022 by Valu. All rights reserved
 *
 * @author Valu
 */
?>

<form method="post" action="./?route=vote" enctype="multipart/form-data">

    <div class="img-container">
        <input id="gallery-photo-add" type="file" name="file[]" multiple><br>
        <div class="gallery">

        </div>
    </div>
    <input type="submit" name="upload">
</form>
<script src="../../../assets/js/limiter.js"></script>