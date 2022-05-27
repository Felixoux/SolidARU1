<?php

namespace App\Attachment;

use Intervention\Image\ImageManager;

abstract class Attachment
{
    protected string $path = '';
    protected array $formats = [];

    public function create($image, $item): void
    {
        $filename = uniqid('', true);
        $manager = new ImageManager(['driver' => 'gd']);
        $this->getSave($manager, $image, $filename);
        $item->setImage($filename);
    }

    /**
     * Save the image with a certain size
     * @param ImageManager $manager
     * @param $image
     * @param string $filename
     * @param string $format
     * @param int $size
     * @return void
     */
    public function getSave(ImageManager $manager, $image, string $filename, string $format = '_small.jpg', int $size = 500): void
    {
        $manager
            ->make($image)
            ->resize($size, null, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->save($this->path . DIRECTORY_SEPARATOR . $filename . $format);
    }

    public function deleteOld($item): void
    {
        $this->detachFile($item, $item->getOldImage());
    }

    public function upload($item): void
    {
        $image = $item->getImage();

        if (empty($image) || $item->shouldUpload() === false) {
            return;
        }
        if (file_exists($this->path) === false) {
            mkdir($this->path, 0777, true);
        }

        // Delete old image
        $this->deleteOld($item);

        // Create image
        $this->create($image, $item);
    }

    public function detach($item): void
    {
        $this->detachFile($item, $item->getImage());
    }

    /**
     * @param $item
     * @param string|null $image
     * @return void
     */
    public function detachFile($item, ?string $image): void
    {
        if (!empty($image)) {
            foreach ($this->formats as $format) {
                $file = $this->path . DIRECTORY_SEPARATOR . $image . '_' . $format . '.jpg';
                if (file_exists($file)) {
                    unlink($file);
                }
            }
        }
    }
}