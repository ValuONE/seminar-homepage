<?php
/*
 * Copyright (c) 2022 by Valu. All rights reserved
 *
 * @author Valu
 */

function e($html): string
{
    return htmlspecialchars($html, ENT_QUOTES, 'UTF-8', true);
}