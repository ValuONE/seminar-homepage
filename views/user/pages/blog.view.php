<?php
/*
 * Copyright (c) 2022 by Valu. All rights reserved
 *
 * @author Valu
 */


if (isset($_SESSION['username'])): ?>

    <div class="add-button-container">
        <a href="./?route=add"><button class="add-button">Blog hinzufügen</button></a>
    </div>

<?php endif; ?>

<div class="container">

    <?php if (isset($data)): ?>

        <?php foreach ($data as $d): ?>

            <div class="container-item">
                <a href="./?route=view&id=<?php echo $d['bid'];?>">
                    <img src="../../../assets/uploads/<?php echo $d['filename'];?>" alt="Picture">
                    <h3><?php echo $d['title'];?></h3>
                    <p><?php echo date("j.n.Y", $d['created_at']);?></p>
                </a>
            </div>

        <?php endforeach; ?>

    <?php endif; ?>

</div>
