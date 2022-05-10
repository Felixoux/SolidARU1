<?php
require AUTOLOAD_PATH;

use App\{Connection, Helpers\Text, Model\Post};
$id = (int)$params['id'];
$slug = $params['slug'];
$pdo = Connection::getPDO();
$query = $pdo->prepare("SELECT * FROM post WHERE id = :id");
$query->execute(['id' => $id]);
$query->setFetchMode(PDO::FETCH_CLASS, Post::class);
/** @var Post|false */
$post = $query->fetch();
// ===========
$categories = $post->getCategories();
foreach ($categories as $k => $category) {
    dd($category->getName());
}

if ($post === false) {
    throw new Exception('Aucun post ne correspond a cet ID');
}
if ($post->getSlug() !== $slug) {
    $url = $router->url('post', ['slug' => $post->getSlug(), 'id' => $id]);
    http_response_code(301);
    header('Location: ' . $url);
    exit();
}
$pageTitle = $post->getName();
?>

<section class="article">
    <header class="article__header flex">
        <h1 class="article__title section-title">
            <?= Text::strong(3, $post->getName()) ?>
        </h1>
        <p class="mobile-hidden muted"><?= $post->getCreatedAt()->format("d/m/Y") ?></p>
    </header>
    <?php if ($post->getImage()): ?>
        <img src="<?= $post->getImageURL('large') ?>" alt="">
    <?php endif ?>
    <div class="article__content">
        <?= $post->getBody() ?>
        <?php foreach ($categories as $k => $category): ?>
        <?= var_dump($category->getName()) . $k ?>
        <?php endforeach; ?>
    </div>
    <a href="#">
        <button class="article__button f-right">Revenir aux articles</button>
    </a>
</section>
   