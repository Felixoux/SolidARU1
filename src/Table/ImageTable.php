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

    public function findPaginated()
    {
        $paginatedQuery = new paginatedQuery(
            "SELECT * FROM image ORDER BY created_at DESC",
            "SELECT COUNT(id) FROM image"
        );
        $images = $paginatedQuery->getItems(Image::class);
        return [$images, $paginatedQuery];
    }

    public function findByName(string $name)
    {
        $query = $this->pdo->prepare('SELECT * FROM ' . $this->table . ' WHERE name = :name');
        $query->execute(['name' => $name]);
        $query->setFetchMode(PDO::FETCH_CLASS, $this->class);
        $result = $query->fetch();
        if ($result === false) {
            throw new NotFoundException($this->table, $name);
        }
        return $result;
    }

    public function list(): array
    {
        $images = $this->queryAndFetchAll("SELECT * FROM $this->table ORDER BY created_at DESC");
        $results = [];
        foreach ($images as $image) {
            $results[$image->getID()] = $image->getName();
        }
        return $results;
    }

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