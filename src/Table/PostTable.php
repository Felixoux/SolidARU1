<?php

namespace App\Table;

use App\{Model\Post, paginatedQuery};

class PostTable extends Table
{
    protected $table = "post";
    protected $class = Post::class;

    public function attachCategories(int $id, array $categories): void
    {
        $this->pdo->exec("DELETE FROM post_category WHERE post_id = " . $id);
        $query = $this->pdo->prepare("INSERT INTO post_category SET post_id = ?, category_id = ?");
        foreach ($categories as $category) {
            $query->execute([$id, $category]);
        }
    }

    public function attachImages(int $id, array $images): void
    {
        $this->pdo->exec("DELETE FROM post_image WHERE post_id = " . $id);
        $query = $this->pdo->prepare("INSERT INTO post_image SET post_id = ?, image_id = ?");
        foreach ($images as $image) {
            $query->execute([$id, $image]);
        }
    }

    public function attachFiles(int $id, array $files): void
    {
        $this->pdo->exec("DELETE FROM post_file WHERE post_id = " . $id);
        $query = $this->pdo->prepare("INSERT INTO post_file SET post_id = ?, file_id = ?");
        foreach ($files as $file) {
            $query->execute([$id, $file]);
        }
    }

    public function findPaginated(): array
    {
        $paginatedQuery = new paginatedQuery(
            "SELECT * FROM $this->table ORDER BY created_at DESC",
            "SELECT COUNT(id) FROM $this->table"
        );
        $posts = $paginatedQuery->getItems(Post::class);
        (new CategoryTable($this->pdo))->hydratePosts($posts);
        return [$posts, $paginatedQuery];
    }

    public function findPaginatedForCategory(int $categoryID): ?array
    {
        $paginatedQuery = new paginatedQuery(
            "SELECT p.*
                FROM $this->table p
                JOIN post_category pc ON pc.post_id = p.id
                WHERE pc.category_id = $categoryID
                ORDER BY created_at DESC",
            "SELECT COUNT(category_id) FROM post_category WHERE category_id = $categoryID",
        );
        $posts = $paginatedQuery->getItems(Post::class);
        (new CategoryTable($this->pdo))->hydratePosts($posts);
        return [$posts, $paginatedQuery];
    }
}