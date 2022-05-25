<?php

namespace App\Helpers;

class Text
{

    /**
     * To summarise a text
     * @param string $content
     * @param int $limit
     * @return string
     */
    public static function exerpt(string $content, int $limit = 60)
    {
        if (mb_strlen($content) <= $limit) {
            return $content;
        }
        $lastSpace = strpos($content, ' ', $limit);
        return substr($content, 0, $lastSpace) . '...';
    }

    /**
     * Put color on a certain word
     * @param int $position
     * @param string $string
     * @return string
     */
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

    public static function getIframe(string $content): string
    {
        return preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i", "<div class='parent-ratio'><div class='ratio'><iframe src=\"//www.youtube.com/embed/$1\" allow='accelerometer;clipboard-write; encrypted-media;gyroscope; picture-in-picture' allowfullscreen></iframe></div></div>", $content);
    }

    public static function noExt(string $string): string
    {
        if (str_contains($string, '/uploads/posts/')) {
            $string = str_replace('/uploads/posts/', '', $string);
        } elseif (str_contains($string, '/uploads/categories/')) {
            $string = str_replace('/uploads/categories/', '', $string);
        }
        $strings = [];
        $strings = explode('.', $string);
        return $strings[0];
    }
}