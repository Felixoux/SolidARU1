<?php

namespace App\Attachment;

use App\Model\Category;
use Intervention\Image\ImageManager;

class CategoryAttachment
{
    const DIRECTORY = UPLOAD_PATH . DIRECTORY_SEPARATOR . "categories";
    public static function upload(Category $category): void
    {
        $image = $category->getImage();

        if(empty($image) || $category->shouldUpload() === false) {
            return;
        }
        if(file_exists(self::DIRECTORY) === false) {
            mkdir(self::DIRECTORY, 0777, true);
        }
        if(!empty($category->getOldImage())) {
            $oldFile = self::DIRECTORY . DIRECTORY_SEPARATOR . $category->getOldImage();
            $formats = ['small', 'large'];
            foreach ($formats as $format) {
                $oldFile = self::DIRECTORY . DIRECTORY_SEPARATOR . $category->getOldImage() . '_' . $format . '.jpg';
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
        $category->setImage($filename);
    }

    public static function detach(Category $category): void
    {
        if(!empty($category->getImage())) {
            $formats = ['small', 'large'];
            foreach ($formats as $format) {
                $file = self::DIRECTORY . DIRECTORY_SEPARATOR . $category->getImage() . '_' . $format . '.jpg';
                if(file_exists($file)) {
                    unlink($file);
                }
            }
        }
    }

}