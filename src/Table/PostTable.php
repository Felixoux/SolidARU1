<?php

namespace App\Table;

use App\{Model\Post, paginatedQuery};

class PostTable extends Table
{

    protected $table = "post";
    protected $class = Post::class;

    public function updatePost(Post $post): void
    {
        $this->update([
            'name' => $post->getName(),
            'slug' => $post->getSlug(),
            'content' => $post->getContent(),
            'created_at' => $post->getCreatedAt()->format("Y-m-d H:i:s"),
            'image' => $post->getImage()
        ], $post->getID());
    }

    public function createPost(Post $post): void
    {
        $id = $this->create([
            'name' => $post->getName(),
            'slug' => $post->getSlug(),
            'content' => $post->getContent(),
            'image' => $post->getImage(),
            'created_at' => $post->getCreatedAt()->format("Y-m-d H:i:s")
        ]);
        $post->setID($id);
    }

    public function attachCategories(int $id, array $categories): void
    {
        $this->pdo->exec("DELETE FROM post_category WHERE post_id = " . $id);
        $query = $this->pdo->prepare("INSERT INTO post_category SET post_id = ?, category_id = ?");
        foreach ($categories as $category) {
            $query->execute([$id, $category]);
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

    public function findPaginatedForCategory(int $categoryID): array
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