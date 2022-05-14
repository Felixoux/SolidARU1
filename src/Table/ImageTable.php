<?php

namespace App\Table;

use App\Model\Image;
use App\paginatedQuery;
use App\Table\Exception\NotFoundException;
use PDO;

class ImageTable extends Table
{
    protected $table = "image";
    protected $class = Image::class;

    public function hydratePosts(array $posts): void
    {
        $postByID = [];
        foreach ($posts as $post) {
            $post->setImages([]);
            $postByID[$post->getID()] = $post;
        }
        $images = $this->pdo
            ->query('
                SELECT i.*, pi.post_id
                FROM post_image pi
                JOIN image i ON i.id = pi.image_id
                WHERE pi.post_id IN (' . implode(',', array_keys($postByID)) . ')'
            )->fetchAll(PDO::FETCH_CLASS, Image::class);
        foreach ($images as $image) {
            $postByID[$image->getPostID()]->addImage($image);
        }
    }
}