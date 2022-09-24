<?php
/*
 * Copyright (c) 2022 by Valu. All rights reserved
 *
 * @author Valu
 */

if (isset($_POST['startEdit']) || isset($showEdit)): ?>

    <form method="post" action="./?route=view">
        <input class="btn-back" type="submit" name="edit" value="Speichern"><br>

        <div class="edit-container">
            <input type="hidden" name="id" value="<?php echo $data['bid'];?>">
            <label>
                Titel:<br>
                <input type="text" name="title" value="<?php echo $data['title'];?>" required>
            </label><br>
            <label><br>
                Inhalt:<br>
                <textarea id="myTextarea" name="content" maxlength="5000"><?php echo $data['content'];?></textarea>
            </label>
        </div>
    </form>

    <h3 class="img-desc">Das Bild lässt sich nicht ändern!</h3>

    <img class="img" src="../../../assets/uploads/<?php echo $data['filename'];?>" alt="Picture">

<?php elseif (isset($_POST['startDelete'])): ?>

    <h3 class="warning-delete">Bist du sicher, dass du deinen Post löschen möchtest?</h3>

    <form method="post" action="./?route=view">
        <input type="hidden" name="id" value="<?php echo $data['bid']; ?>">
        <input class="btn-delete" type="submit" name="delete" value="Löschen">
    </form>

<?php else: ?>

    <a href="./?route=blog"><button class="btn-back">Zurück</button></a>

    <?php if (isset($_SESSION['username'])): ?>

        <?php if ($data['author'] === $_SESSION['username']): ?>

            <form method="post" action="./?route=view&id=<?php echo $data['bid']; ?>">
                <input class="btn-delete" type="submit" name="startDelete" value="Löschen">
            </form>

            <form method="post" action="./?route=view&id=<?php echo $data['bid']; ?>">
                <input class="btn-edit" type="submit" name="startEdit" value="Bearbeiten">
            </form>

        <?php endif; ?>

    <?php endif; ?>

    <?php if (isset($_GET['error'])): ?>

        <h3 class="warning">Es müssen alle Felder ausgefüllt sein!</h3>

    <?php endif; ?>

    <div class="container">
        <h1 class="title"><?php echo $data['title'];?></h1>
        <p class="date"><?php echo date("j.n.Y H:i", $data['created_at']);?></p>
        <p class="text"><?php echo $data['content'];?></p>
        <p class="author">Verfasst von <?php echo $data['author'];?></p>
        <img class="img" src="../../../assets/uploads/<?php echo $data['filename'];?>" alt="Picture">
    </div>

<?php endif; ?>
