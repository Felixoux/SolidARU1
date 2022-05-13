<?php

namespace App;

use http\Cookie;

class Helper
{

    public static function sessionStart(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function createCookie(string $name, string $value, string $domain, int $time): void
    {
        setcookie($name, $value, $time, '/', $domain, false,
            true);
    }


}