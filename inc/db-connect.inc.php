<?php
/*
 * Copyright (c) 2022 by Valu. All rights reserved
 *
 * @author Valu
 */

try {
    $pdo = new PDO('mysql:host=localhost;dbname=website-2', 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    return $pdo;
}
catch(PDOException $e) {
    die('[MYSQL] Could not establish database connection...');
}