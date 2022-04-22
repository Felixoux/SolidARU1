<?php
require dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'vendor/autoload.php';
use App\{Connection, Model\Post, Helpers\Text, Model\Category};

$id = (int)$params['id'];
$slug = $params['slug'];

$pdo = Connection::getPDO();
$query = $pdo->prepare("SELECT * FROM post WHERE id = :id");
$query->execute(['id' => $id]);
$query->setFetchMode(PDO::FETCH_CLASS, Post::class);
/** @var Post|false */
$post = $query->fetch();


if($post === false) {
    throw new Exception('Aucun post ne correspond a cet ID');
}
if($post->getSlug() !== $slug) {
    $url = $router->url('post', ['slug' => $post->getSlug(), 'id' => $id]);
    http_response_code(301);
    header('Location: ' . $url);
    exit();
}

$pageTitle = $post->getName();

?>

<section class="article">
    <h1 class="article__title">
        <?= Text::strong(3, $post->getName()) ?>
    </h1>
    <p class="article__content">
        <?= $post->getFormattedContent() ?>
    </p>
    
    <a href="#">
        <button class="article__button f-right">Revenir aux articles</button>
    </a>
</section>
   