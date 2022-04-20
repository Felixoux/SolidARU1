<?php 
require dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'vendor/autoload.php';

use App\Connection;
use App\Helpers;
use App\Helpers\Text;
use App\Model\Category;
use App\Model\Post;
use App\URL;

$pageTitle = "Mon blog";
$pdo = Connection::getPDO();

$currentPage = URL::getPositiveInt('page', 1);

$count = (int)$pdo->query("SELECT COUNT(id) FROM post")->fetch(PDO::FETCH_NUM)[0];
$per_page = 2;
$offset = $per_page * ($currentPage - 1) ;
$pages = ceil($count / $per_page);
if($currentPage > $pages) {
    throw new Exception('Cette page n\'existe pas');
}
$query = $pdo->query("SELECT * FROM post LIMIT $per_page OFFSET $offset");
$posts = $query->fetchAll(PDO::FETCH_CLASS, Post::class);
?>

<img class="mobile-only" src="img/banner.jpg" alt="banner" width="1920">
<div class="banner mobile-hidden"></div>

<section class="home-little-grid">
    <div class="card home-card-big">
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
        <h2 id="event">Voici les différents <strong>types</strong> d'évènements</h2>
        <p class="mobile-hidden">Mis à jour le 02/03/2022</p>
    </div>
    <div class="big-grid-event">
        <?php foreach($posts as $post): ?>
            <?php require 'card.php'; ?>
        <?php endforeach ?>
    </div>
</section>

<footer class="mb4 mt4">
    <?php if($currentPage > 1): ?>
        <?php 
            $link = $router->url('home');
            if($currentPage > 2) $link .= '?page=' . ($currentPage - 1); 
        ?>
        <a href="<?= $link ?>"><button class="btn btn-swap">Page précédente</button></a>
    <?php endif ?>
    <?php if($currentPage < $pages): ?>
        <?php 
            $link = $router->url('home');
            if($currentPage < $pages) $link .= '?page=' . ($currentPage + 1); 
        ?>
        <a href="<?= $link ?>"><button class="btn btn-swap">Page suivante</button></a>
    <?php endif ?>
</footer>




