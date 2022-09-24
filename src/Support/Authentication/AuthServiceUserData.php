<?php
/*
 * Copyright (c) 2022 by Valu. All rights reserved
 *
 * @author Valu
 */

namespace Valu\App\Support\Authentication;

class AuthServiceUserData
{
    public int $uid;
    public string $username;
    public string $password;
    public string $created_at;
    public bool $verified;
}