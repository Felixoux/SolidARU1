<?php 
namespace App\Table;
use App\{Model\Category, paginatedQuery, Model\Post};
use PDO;
use App\Table\Exception\NotFoundException;
class PostTable extends Table{

    protected $table = "post"; 
    protected $class = Post::class;

    public function findPaginated()
    {
        $paginatedQuery = new paginatedQuery(
            "SELECT * FROM post ORDER BY created_at DESC",
            "SELECT COUNT(id) FROM post"
        );
        $posts = $paginatedQuery->getItems(Post::class);
        (new CategoryTable($this->pdo))->hydratePosts($posts);
        return [$posts, $paginatedQuery];
    }

    public function findPaginatedForCategory(int $categoryID)
    {
        $paginatedQuery = new paginatedQuery(
            "SELECT p.*
                FROM post p
                JOIN post_category pc ON pc.post_id = p.id
                WHERE pc.category_id = {$categoryID}
                ORDER BY created_at DESC",
            "SELECT COUNT(category_id) FROM post_category WHERE category_id = {$categoryID}",
        );
        $posts = $paginatedQuery->getItems(Post::class);
        (new CategoryTable($this->pdo))->hydratePosts($posts);
        return [$posts, $paginatedQuery];
    }


}