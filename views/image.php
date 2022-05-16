<?php

use App\Router;

if(!isset($_GET['width']) || !isset($_GET['height']) || !isset($_GET['name'])) {
    http_response_code(404);
    header('Location: ' . $router->url('e404'));
    exit();
}
$newwidth = min(1024, max(2, htmlentities($_GET["width"], ENT_QUOTES, "UTF-8")));
$newheight = min(1024, max(2, htmlentities($_GET["height"], ENT_QUOTES, "UTF-8")));
$name = htmlentities($_GET["name"], ENT_QUOTES, "UTF-8");

$url = UPLOAD_PATH.DIRECTORY_SEPARATOR."posts_multiple".DIRECTORY_SEPARATOR.$name;
$format = explode(".", $url)[1];


list($width, $height) = @getimagesize($url);

if ($url and $width):

    $r = $width / $height;
    if ($newwidth / $newheight > $r) {
        $newwidth = $newheight * $r;
    } else {
        $newheight = $newwidth / $r;
    }

    switch ($format) {
        case "jpg":
            $src = imagecreatefromjpeg($url);
            $dst = imagecreatetruecolor($newwidth, $newheight);
            imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
            header('Content-type: image/jpg');
            imagejpeg($dst);
            break;
        case "png":
            $src = imagecreatefrompng($url);
            imagesavealpha($src, true);

            $dst = imagecreatetruecolor($newwidth, $newheight);

            // Make a new transparent image and turn off alpha blending to keep the alpha channel
            $background = imagecolorallocatealpha($dst, 255, 255, 255, 127);
            imagecolortransparent($dst, $background);
            imagealphablending($dst, false);
            imagesavealpha($dst, true);

            imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
            header('Content-type: image/png');
            imagepng($dst);
            break;
        case "gif":
            file_get_contents($url);
            $src = imagecreatefromgif($url);
            $dst = imagecreatetruecolor($newwidth, $newheight);
            imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
            header('Content-type: image/gif');
            imagegif($dst);
            break;
        default:
            $src = imagecreatefromstring(file_get_contents($url));
            $dst = imagecreatetruecolor($newwidth, $newheight);
            imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
            header('Content-type: image/jpg');
            imagejpeg($dst);
    }
    imagedestroy($dst);
    exit();
endif;

http_response_code(400);
exit();

?>