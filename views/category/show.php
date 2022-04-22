<?php
require dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'vendor/autoload.php';
use App\{Connection, Model\Post, Helpers\Text, Model\Category, paginatedQuery, URL};

$id = (int)$params['id'];
$slug = $params['slug'];

$pdo = Connection::getPDO();
$query = $pdo->prepare("SELECT * FROM category WHERE id = :id");
$query->execute(['id' => $id]);
$query->setFetchMode(PDO::FETCH_CLASS, Category::class);
/** @var Category|false */
$category = $query->fetch();

if($category === false) {
    throw new Exception('Aucun post ne correspond a cet ID');
}
if($category->getSlug() !== $slug) {
    $url = $router->url('category', ['id' => $category->getID(), 'slug' => $category->getSlug()]);
    http_response_code(301);
    header('Location: ' . $url);
    exit();
}
$pageTitle = $category->getName();

$paginatedQuery = new paginatedQuery(
    "SELECT p.*
        FROM post p
        JOIN post_category pc ON pc.post_id = p.id
        WHERE pc.category_id = {$category->getID()}
        ORDER BY created_at DESC",
    "SELECT COUNT(category_id) FROM post_category WHERE category_id = {$category->getID()}",
    Post::class
);
$posts = $paginatedQuery->getItems();

$link = $router->url('category', ['id' => $category->getID(), 'slug' => $category->getSlug()]);
?>

<section class="event">
    <div class="header-section flex">
        <h2 id="event">Voici les posts liés au thème <strong><?= e($category->getName()) ?></strong></h2>
        <p class="mobile-hidden silent">Mis à jour le 02/03/2022</p>
    </div>
    <div class="big-grid-event">
    <?php foreach ($posts as $post): ?>
        <?php require VIEW_PATH . '/post/card.php'; ?>
    <?php endforeach ?>
    </div>
    <div class="footer-links">
    <?= $paginatedQuery->previousLink($link) ?>
    <?= $paginatedQuery->nextLink($link) ?>
    </div>
</section>
   
