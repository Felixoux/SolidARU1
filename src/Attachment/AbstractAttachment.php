<?php

namespace App\Attachment;

use App\Model\Post;
use Intervention\Image\ImageManager;

class AbstractAttachment
{
    protected $class = null; // Category
    protected $object = null; // $category
    protected $path = null; // categories
    const DIRECTORY = null;
    public static function upload($object): void
    {
        $object = $this->object;
        $image = $object->getImage();

        if(empty($image) || $object->shouldUpload() === false) {
            return;
        }
        if(file_exists(self::DIRECTORY) === false) {
            mkdir(self::DIRECTORY, 0777, true);
        }
        if(!empty($object->getOldImage())) {
            $oldFile = self::DIRECTORY . DIRECTORY_SEPARATOR . $object->getOldImage();
            $formats = ['small', 'large'];
            foreach ($formats as $format) {
                $oldFile = self::DIRECTORY . DIRECTORY_SEPARATOR . $object->getOldImage() . '_' . $format . '.jpg';
                if(file_exists($oldFile)) {
                    unlink($oldFile);
                }
            }
        }
        $filename = uniqid('', true);
        $manager = new ImageManager(['driver' => 'gd']);
        $manager
            ->make($image)
            ->resize(350, null, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->save(self::DIRECTORY . DIRECTORY_SEPARATOR . $filename . '_small.jpg') ;
        $manager
            ->make($image)
            ->resize(1280, null, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->save(self::DIRECTORY . DIRECTORY_SEPARATOR . $filename . '_large.jpg') ;
        $object->setImage($filename);
    }

    public static function detach($object): void
    {
        $object = $this->object;
        if(!empty($object->getImage())) {
            $formats = ['small', 'large'];
            foreach ($formats as $format) {
                $file = self::DIRECTORY . DIRECTORY_SEPARATOR . $object->getImage() . '_' . $format . '.jpg';
                if(file_exists($file)) {
                    unlink($file);
                }
            }
        }
    }
}