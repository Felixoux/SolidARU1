<?php

namespace App\Table;

use App\{Model\Category};
use PDO;

class CategoryTable extends Table
{
    protected $table = "category";
    protected $class = Category::class;

    /** @param App\Model\Post[] $posts */
    public function hydratePosts(array $posts): void
    {
        $postByID = [];
        foreach ($posts as $post) {
            $post->setCategories([]);
            $postByID[$post->getID()] = $post;
        }
        $categories = $this->pdo
            ->query('
                SELECT c.*, pc.post_id
                FROM post_category pc
                JOIN category c ON c.id = pc.category_id
                WHERE pc.post_id IN (' . implode(',', array_keys($postByID)) . ')'
            )->fetchAll(PDO::FETCH_CLASS, Category::class);
        foreach ($categories as $category) {
            $postByID[$category->getPostID()]->addCategory($category);
        }
    }

    public function all(): array
    {
        return $this->queryAndFetchAll("SELECT * FROM $this->table ORDER BY created_at DESC");
    }

    /**
     * Count the number of posts in a category
     * @param int $categoryID
     * @return int
     */
    public function countPost(int $categoryID): int
    {
        $query = $this->pdo->query("
                SELECT COUNT(id)
                FROM post p
                JOIN post_category pc ON pc.post_id = p.id
                WHERE pc.category_id = $categoryID
        ")->fetchAll();
        return $query[0]['COUNT(id)'];
    }
}