<?php

namespace App\Attachment;

use App\Model\Post;
use Intervention\Image\ImageManager;

class PostAttachment
{
    const DIRECTORY = UPLOAD_PATH . DIRECTORY_SEPARATOR . "posts";
     public static function upload(Post $post): void
        {
            $image = $post->getImage();

            if(empty($image) || $post->shouldUpload() === false) {
                return;
            }
            if(file_exists(self::DIRECTORY) === false) {
                mkdir(self::DIRECTORY, 0777, true);
            }
            if(!empty($post->getOldImage())) {
                $oldFile = self::DIRECTORY . DIRECTORY_SEPARATOR . $post->getOldImage();
                $formats = ['small', 'large'];
                foreach ($formats as $format) {
                    $oldFile = self::DIRECTORY . DIRECTORY_SEPARATOR . $post->getOldImage() . '_' . $format . '.jpg';
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
            $post->setImage($filename);
        }

     public static function detach(Post $post): void
 {
     if(!empty($post->getImage())) {
         $formats = ['small', 'large'];
         foreach ($formats as $format) {
             $file = self::DIRECTORY . DIRECTORY_SEPARATOR . $post->getImage() . '_' . $format . '.jpg';
             if(file_exists($file)) {
                 unlink($file);
             }
         }
     }
 }
}