<?php
App\Helper::sessionStart();

use App\{Connection, Model\Category, Table\CategoryTable, Table\PostTable};

$id = (int)$params['id'];
$slug = $params['slug'];
$pdo = Connection::getPDO();
/** @var Category|false */
$category = (new CategoryTable($pdo))->find($id);

$pageTitle = $category->getName(); // Tab name
$pageSummary = $category->getExerpt(150);

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

<main class="event big-section">
    <header class="header-section flex">
        <h2 id="event" class="section-title">Voici les posts liés au thème <strong><?= $category->getName()
                ?></strong>
    </header>
    <p class="js-hide mt1"><?= $category->getContent() ?></p>
    <section class="big-grid-event">
        <?php foreach ($posts as $post): ?>
            <?php require VIEW_PATH.DIRECTORY_SEPARATOR.'post/card.php'; ?>
        <?php endforeach ?>
    </section>
    <footer class="footer-links">
        <?= $pagination->previousLink($link) ?>
        <?= $pagination->nextLink($link) ?>
    </footer>
</main>
   
