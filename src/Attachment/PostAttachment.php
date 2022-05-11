<?php

namespace App\Attachment;

use Intervention\Image\ImageManager;

class PostAttachment extends Attachment
{

    protected $path = UPLOAD_PATH . DIRECTORY_SEPARATOR . "posts";
    protected $formats = ['small', 'large'];

    public function create($image, $item): void
    {
        $filename = uniqid('', true);
        $manager = new ImageManager(['driver' => 'gd']);
        $manager
            ->make($image)
            ->resize(350, null, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->save($this->path . DIRECTORY_SEPARATOR . $filename . '_small.jpg');

        $manager
            ->make($image)
            ->resize(1280, null, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->save($this->path . DIRECTORY_SEPARATOR . $filename . '_large.jpg');
        $item->setImage($filename);
    }

    public function deleteOld($item): void
    {
        if (!empty($item->getOldImage())) {
            foreach ($this->formats as $format) {
                $oldFile = $this->path . DIRECTORY_SEPARATOR . $item->getOldImage() . '_' . $format . '.jpg';
                if (file_exists($oldFile)) {
                    unlink($oldFile);
                }
            }
        }
    }

    public function detach($item): void
    {
        if (!empty($item->getImage())) {
            foreach ($this->formats as $format) {
                $file = $this->path . DIRECTORY_SEPARATOR . $item->getImage() . '_' . $format . '.jpg';
                if (file_exists($file)) {
                    unlink($file);
                }
            }
        }
    }
}