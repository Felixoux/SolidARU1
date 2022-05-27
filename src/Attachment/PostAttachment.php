<?php

namespace App\Attachment;

use Intervention\Image\ImageManager;

class PostAttachment extends Attachment
{

    protected string $path = UPLOAD_PATH . DIRECTORY_SEPARATOR . "posts";
    protected array $formats = ['small', 'large'];

    public function create($image, $item): void
    {
        $filename = uniqid('', true);
        $manager = new ImageManager(['driver' => 'gd']);
        $this->getSave($manager, $image, $filename);
        $this->getSave($manager, $image, $filename,'_large.jpg', 1280);
        $item->setImage($filename);
    }
}