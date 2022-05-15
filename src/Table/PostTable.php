<?php

namespace App\Table;

use App\{Connection, Model\Post, paginatedQuery};
use PDO;

class PostTable extends Table
{
    protected $table = "post";
    protected $class = Post::class;

    /**
     * Permet de trouver tous les posts d'une catégorie
     * @param int $categoryID
     * @return array
     * @throws \Exception
     */
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

    /**
     * Permet de set les images et les fichiers pour un post
     * @param PDO $pdo
     * @param Post $post
     * @return void
     */
    public function attachAll(PDO $pdo, Post $post): void
    {
        (new CategoryTable($pdo))->attachItems($post->getID(), $_POST['categories_ids']);
        if (isset($_POST['images_ids'])) {
            (new ImageTable($pdo))->attachItems($post->getID(), $_POST['images_ids']);
        }
        if (isset($_POST['files_ids'])) {
            (new FileTable($pdo))->attachItems($post->getID(), $_POST['files_ids']);
        }
    }

    /**
     * Permet de récupérer les images et les fichiers pour un post
     * @param $id
     * @return array
     */
    public function getAttach($id)
    {
        $images = (new ImageTable($this->pdo))->getAttachForPost($id);
        $files = (new FileTable($this->pdo))->getAttachForPost($id);
        return [$images, $files];
    }
}