<?php
$pageTitle = "Accueil";
use App\{Connection, Table\CategoryTable};

$pdo = Connection::getPDO();

$table = new CategoryTable($pdo);
[$categories, $pagination] = $table->findPaginated();
$postTable = new \App\Table\PostTable($pdo);
$link = $router->url('home');
?>

<img class="mobile-only" src="img/locker__outside--big.jpg" alt="bannière">
<div class="banner mobile-hidden"></div>

<section class="home-little-grid relative">
    <div class="card home-card-big">
        <h1 class="big-title">
            Bienvenue sur le site de solid<strong>ARU1</strong>
        </h1>
        <h2 class="big-title">
            Que vais-je trouver sur ce <strong>blog</strong> ?
        </h2>
        <h3>
            Ici vous retrouverez tous les évènements se passant <br>
            dans L’Athénée royal d'Uccle 1 concernant la solidarité, comme par exemple <br>
            la semaine de la solidarité ou encore les shoeboxs.
        </h3>
    </div>
    <div class="card home-card-little">
        <h2 class="big-title">
            Comment ça <strong>fonctionne</strong> ?
        </h2>
        <h4 class="muted">
            Ce site est en quelque sorte un journal de bord des évènements.
            De nombreux articles vont être ajoutés au fil du temps pour en garder une trace.
            Dans ceux-ci il y aura du texte, des photos, des vidéos, voire même des documents.
        </h4>
    </div>
</section>
<section class="event big-section">
    <header class="header-section flex">
        <h2 class="section-title">Voici les différentes <strong>catégories</strong>
            <svg class="category_svg">
                <use xlink:href="/img/svg/sprite.svg#category-title"></use>
            </svg>
        </h2>
        <p class="mobile-hidden muted">Mis à jour le 22/04/22</p>
    </header>
    <?php if (isset($_GET['empty'])): ?>
        <p class="alert alert-danger">La catégorie ne contient aucun article</p>
    <?php endif ?>
    <div class="big-grid-event">
        <?php  $colors = ["#FF883D", "#41CF7C", "#54aae8", "#8893C4"] ?>
        <?php foreach ($categories as $category): ?>
            <?php $color = $colors[($category->getID()%count($colors))] ?>
            <?php $numberPost = $table->countPost($category->getID()) ?>
            <?php require VIEW_PATH . '/category/card.php'; ?>
        <?php endforeach ?>
    </div>
    <footer class="footer-links">
        <?= $pagination->previousLink($link) ?>
        <?= $pagination->nextLink($link) ?>
    </footer>
</section>