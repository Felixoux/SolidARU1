<?php
App\Helper::sessionStart();
use App\{Connection, Table\CategoryTable, Table\PostTable};

$id = (int)$params['id'];
$slug = $params['slug'];
$pdo = Connection::getPDO();
$category = (new CategoryTable($pdo))->find($id);

if($category === false ) {
    header('location: /');
}
$pageTitle = $category->getName(); // Tab name

if ($category->getSlug() !== $slug) {
    $url = $router->url('category', ['id' => $category->getID(), 'slug' => $category->getSlug()]);
    http_response_code(301);
    header('Location: ' . $url);
    exit();
}
[$posts, $pagination] = (new PostTable($pdo))->findPaginatedForCategory($id);

$link = $router->url('category', ['id' => $category->getID(), 'slug' => $category->getSlug()]);
$_SESSION['category_link'] = $router->url('category', ['id' => $category->getID(), 'slug' => $category->getSlug()]); // To remember the link
?>

<section class="event big-section">
    <div class="header-section flex">
        <h2 id="event" class="section-title">Voici les posts liés au thème <strong><?= $category->getName()
                ?></strong>
            <img width="50" src="/img/online.png" alt="posts"></h2>
    </div>
    <p class="js-hide"><?= $category->getContent() ?></p>
    <!--<a class="button-js-hide">Voir plus</a>-->
    <div class="big-grid-event">
        <?php foreach ($posts as $post): ?>
            <?php require VIEW_PATH . '/post/card.php'; ?>
        <?php endforeach ?>
    </div>
    <div class="footer-links">
        <?= $pagination->previousLink($link) ?>
        <?= $pagination->nextLink($link) ?>
    </div>
</section>
   
