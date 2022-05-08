<?php

namespace App\Helpers;

class Text
{

    public static function exerpt(string $content, int $limit = 60)
    {
        if (mb_strlen($content) <= $limit) {
            return $content;
        }
        $lastSpace = strpos($content, ' ', $limit);
        return substr($content, 0, $lastSpace) . '...';
    }

    public static function strong(int $position = 3, string $string): string
    {
        if (strlen($string) < 50) {
            return $string;
        }
        $strArray = explode(' ', $string);
        $word = $strArray[$position - 1];
        $replace = '<strong>' . $word . '</strong>';
        return str_replace($word, $replace, $string);
    }

    public static function parseDown(string $content): string
    {
        $parseDown = new \Parsedown();
        $parseDown->setSafeMode(false);
        return $parseDown->text($content);
    }

    public static function replaceByIframe(string $content): string
    {
        return <<<HTML
        <iframe width="560" height="315" src="https://www.youtube.com/watch?v=BURRD_nWJh0" title="YouTube video player" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
HTML;
    }
}