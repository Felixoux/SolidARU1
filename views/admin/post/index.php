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
    <section class="post-listing">
        <div class="post-listing__header">
            <h3>#</h3>
            <h3>Titre</h3>
            <h3>Action</h3>
        </div>
        <section class="post-listing__body">
            <?php foreach($posts as $post): ?>
            <div class="card-design admin-card">
                <h4 class="admin-card__id"><?= e($post->getID()) ?></h4>  
                <h3 class="admin-card__itle"><?= e($post->getName()) ?></h3>   
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
        
    </section>
</div>

