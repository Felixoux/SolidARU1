<?php
require AUTOLOAD_PATH;

use App\{Connection, Helpers\Text, Model\Post, Table\PostTable};

$id = (int)$params['id'];
$slug = $params['slug'];
$pdo = Connection::getPDO();
/** @var Post|false */
$post = (new PostTable($pdo))->find($id);
$images = $pdo->query("
SELECT i.*
FROM image i 
JOIN post_image pi ON i.id = pi.image_id
WHERE pi.post_id = $id ")->fetchAll();

$files = $pdo->query("
SELECT f.*
FROM file f 
JOIN post_file pf ON f.id = pf.file_id
WHERE pf.post_id = $id ")->fetchAll();

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
        <!--<img src="<?/*= $post->getImageURL('small') */?>" alt="">-->
    <?php endif ?>
    <div class="article__images">
        <?php foreach ($images as $k => $image) {
            $name = $image['name'];
            $link = '/uploads/posts_multiple' . DIRECTORY_SEPARATOR . $image['name'];
            echo <<<HTML
        <img src="$link" alt="$name" width="350">
        HTML;
        }
        ?>
    </div>
    <div class="article__content">
        <?= $post->getBody() ?>
    </div>
    <div class="article__files">
        <?php foreach ($files as $k => $file) {
            $name = $file['name'];
            $link = '/uploads/files' . DIRECTORY_SEPARATOR . $file['name'];
            echo <<<HTML
            <p>
                <a href="$link">$name</a>
            </p>
            HTML;
        }
        ?>
    </div>
    <a href="#">
        <button class="article__button f-right">Revenir aux articles</button>
    </a>
</section>