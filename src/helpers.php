<?php 

function e(?string $string): ?string
{
    return htmlentities($string, ENT_HTML5);
}