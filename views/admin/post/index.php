<?php
use App\Connection;
use App\Model\Post;
use App\Helpers\Text;
require ROOT_PATH . '/vendor/autoload.php';

$pageTitle = 'Administration du site';
$pdo = Connection::getPDO();
$query = $pdo->query("SELECT * FROM post");
$posts = $query->fetchAll(PDO::FETCH_CLASS, Post::class);


?>

<div class="admin-wrapper">
    <a href="#">
        <button class="btn btn-swap">Ajouter un article</button>
    </a>
    <aside class="admin-aside">
        <div><a href="#">Page article</a></div>
        <div><a href="#">Page catégorie</a></div>
        <div><a href="#">Page sécurité</a></div>
    </aside>
    <section class="post-listing">
        <?php foreach($posts as $post): ?>
            <div class="card admin-card">
                <h3 class="admin-card__title"><?= $post->getName() ?></h3>
                <div class="admin-card__option">
                    <a href="#">
                        <button class="btn btn-primary">Éditer</button>
                    </a>
                    <a href="#">
                        <button class="btn btn-alert">Supprimer</button>
                    </a>
                </div>
            </div>
        <?php endforeach ?>
    </section>
</div>

