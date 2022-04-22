<?php 
require dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'vendor/autoload.php';

use App\Connection;
use App\Helpers;
use App\Helpers\Text;
use App\Model\Category;
use App\Model\Post;
use App\paginatedQuery;
use App\URL;
$pageTitle = "Mon blog";
$paginatedQuery = new paginatedQuery(
    "SELECT * FROM category",
    "SELECT COUNT(id) FROM category",
    Category::class, 
    4
);
$categories = $paginatedQuery->getItems();
$link = $router->url('home');
?>

<img class="mobile-only" src="img/banner.jpg" alt="banner" width="1920">
<div class="banner mobile-hidden"></div>

<section class="home-little-grid">
    <div class="card home-card-big stack">
        <div class="card__body stack">
            <h1 class="card__title">Bienvenue sur le site de solid<strong>ARU1</strong>
            </h1>
            <h2>
                Que vais-je trouver sur ce <strong>blog</strong> ?  
            </h2>
            <h4>
                Ici vous retrouverez tous les évenements se passant <br>
                dans l’athénée concernant la solidarité, comme par exemple <br>
                la semaine de la solidarité ou encore les shoeboxs.
            </h4>
        </div>
    </div>
    <div class="card home-card-little ">
        <div class="card__body stack">
            <h2 class="card__title">
                Comment ça <strong>fonctionne</strong> ? 
            </h2>
            <h4 class="silent">
                Ce site est en quelque sorte un journal des événements. 
                De nombreux posts vont être ajoutés au fil du temps pour en garder une trace.
                Dans ces posts il y aura du texte, photos, vidéos voire même documents.
            </h4>
        </div>
    </div>
</section>

<section class="event">
    <div class="header-section flex">
        <h2 id="event">Voici les différents <strong>thèmes</strong></h2>
        <p class="mobile-hidden">Mis à jour le 02/03/2022</p>
    </div>
    <div class="big-grid-event">
        <?php foreach($categories as $category): ?>
            <?php require VIEW_PATH . '/category/card.php'; ?>
        <?php endforeach ?>
    </div>

    <div class="footer-links">
        <?= $paginatedQuery->previousLink($link) ?>
        <?= $paginatedQuery->nextLink($link) ?>
    </div>
</section>





