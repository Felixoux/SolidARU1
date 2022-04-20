<?php 
require dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'vendor/autoload.php';
$pdo = new PDO("mysql:host=localhost;dbname=solidaru1", "root", "", [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

$query = $pdo->query('SELECT * FROM post');
$posts = $query->fetchAll();

$pageTitle = "Mon blog";
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
        <h2 id="event">Voici les <strong>différents</strong> évènements</h2>
        <p class="mobile-hidden">Mis à jour le 02/03/2022</p>
    </div>
    <div class="big-grid-event">
        <?php foreach($posts as $post): ?>
            <article class="card card-article">
                <div class="card__body stack">
                    <h4 class="card__title">
                        <?= $post['name'] ?>
                    </h4>
                    <p class="card__content">
                        <?= $post['content'] ?>
                    </p>
                </div>
                <div class="card__footer">
                    <a href="#"><button class="btn btn-swap f-right">Bouton</button></a>
                </div>
            </article>   
        <?php endforeach ?>
    </div>
</section>




