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
    public static function strong(int $position, string $string): string
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

    public static function getPhoneIframe(string $content): ?string
    {
        $shortUrlRegex = '/youtu.be\/([a-zA-Z0-9_-]+)\??/i';
        if (preg_match($shortUrlRegex, $content, $matches)) {
            $youtube_id = $matches[count($matches) - 1];
            $url = 'https://youtu.be/' . $youtube_id;
            $new_url =  'https://www.youtube.com/embed/' . $youtube_id ;
            $iframe = "<div class='parent-ratio'><div class='ratio'><iframe src=\"$new_url\" allow='accelerometer;clipboard-write; encrypted-media;gyroscope; picture-in-picture' allowfullscreen></iframe></div></div>";;
            return str_replace($url, $iframe, $content);
        }
        return null;
    }

    public static function getDesktopIframe(string $content): ?string
    {
        $longUrlRegex = '/youtube.com\/((?:embed)|(?:watch))((?:\?v\=)|(?:\/))([a-zA-Z0-9_-]+)/i';
        if (preg_match($longUrlRegex, $content, $matches)) {
            $youtube_id_long = $matches[count($matches) - 1];
            $url_long = 'https://www.youtube.com/watch?v=' . $youtube_id_long;
            $new_url_long =  'https://www.youtube.com/embed/' . $youtube_id_long ;
            $iframe = "<div class='parent-ratio'><div class='ratio'><iframe src=\"$new_url_long\" allow='accelerometer;clipboard-write; encrypted-media;gyroscope; picture-in-picture' allowfullscreen></iframe></div></div>";
            return str_replace($url_long, $iframe, $content);
        }
        return null;
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