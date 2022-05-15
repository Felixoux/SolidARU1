<?php

function e(?string $content): string
{
    return htmlentities($content, ENT_QUOTES, "UTF-8", false);
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

function C($key): string
{
    $file = ROOT_PATH . DIRECTORY_SEPARATOR . 'config.json';
    $data = file_get_contents($file);
    $obj = json_decode($data);
    return $obj->$key;
}

function crypto_rand_secure($min, $max)
{
    $range = $max - $min;
    if ($range < 1) return $min; // not so random...
    $log = ceil(log($range, 2));
    $bytes = (int) ($log / 8) + 1; // length in bytes
    $bits = (int) $log + 1; // length in bits
    $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
    do {
        $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
        $rnd = $rnd & $filter; // discard irrelevant bits
    } while ($rnd > $range);
    return $min + $rnd;
}

function getToken($length)
{
    $token = "";
    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
    $codeAlphabet.= "0123456789";
    $max = strlen($codeAlphabet); // edited

    for ($i=0; $i < $length; $i++) {
        $token .= $codeAlphabet[crypto_rand_secure(0, $max-1)];
    }

    return $token;
}

function resize_image($file, $w, $h, $crop=FALSE) {
    list($width, $height) = getimagesize($file);
    $r = $width / $height;
    if ($crop) {
        if ($width > $height) {
            $width = ceil($width-($width*abs($r-$w/$h)));
        } else {
            $height = ceil($height-($height*abs($r-$w/$h)));
        }
        $new_width = $w;
        $new_height = $h;
    } else {
        if ($w/$h > $r) {
            $new_width = $h*$r;
            $new_height = $h;
        } else {
            $new_height = $w/$r;
            $new_width = $w;
        }
    }
    $src = imagecreatefromjpeg($file);
    $dst = imagecreatetruecolor($new_width, $new_height);
    imagecopyresampled($dst, $src, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

    return $dst;
}

