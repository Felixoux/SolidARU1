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
    <table class="post-listing">
        <thead>
            <tr>
                <th><h3>#</h3></th>
                <th><h3>Titre</h3></th>
                <th><h3>Action</h3></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($posts as $post): ?>
            <tr>
                <td><?= e($post->getID()) ?></td>
                <td><?= e($post->getName()) ?></td>
                <td>Salut</td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

