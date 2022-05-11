<?php

function e(?string $string): ?string
{
    return htmlspecialchars($string, ENT_QUOTES);
}

function ob_before(string $string): string
{
    ob_start();
    echo($string);
    return ob_get_clean();
}

function ob_after(string $string): string
{
    ob_start();
    echo($string);
    return ob_get_clean();
}