<?php

namespace App;

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

    public static function svg(string $name, ?string $classes = ""): string
    {
        return <<<HTML
        <svg class="$classes">
            <use xlink:href="/img/svg/sprite.svg#$name"></use>
        </svg>
HTML;

    }
}