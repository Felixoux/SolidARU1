<?php

namespace App\Attachment;

use Intervention\Image\ImageManager;

abstract class Attachment
{
    protected $path = null;
    protected $formats = [];

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
        $item->setImage($filename);
    }

    public function deleteOld($item): void
    {
        if(!empty($item->getOldImage())) {
            $oldFile = $this->path . DIRECTORY_SEPARATOR . $item->getOldImage() . '_small.jpg';
            if(file_exists($oldFile)) {
                unlink($oldFile);
            }
        }
    }

    public function upload($item): void
    {
        $image = $item->getImage();

        if(empty($image) || $item->shouldUpload() === false) {
            return;
        }
        if(file_exists($this->path) === false) {
            mkdir($this->path, 0777, true);
        }

        // Delete old image
        $this->deleteOld($item);

        // Create image
        $this->create($image, $item);
    }

    public function detach($item): void
    {
        if(!empty($item->getImage())) {
            $file = $this->path . DIRECTORY_SEPARATOR . $item->getImage() . '_small.jpg';
            if(file_exists($file)) {
                unlink($file);
            }
        }
    }
}