<?php
use App\{Connection, Table\PostTable, Auth};

require ROOT_PATH . '/vendor/autoload.php';
Auth::check();
$pageTitle = 'Administration du site';
$pdo = Connection::getPDO();
$link = $router->url('admin_posts');
[$posts, $pagination] = (new PostTable($pdo))->findPaginated();

?>
<?php if(isset($_GET['delete'])): ?>
    <div class="container">
        <p class="alert alert-success">L'article a bien été supprimé</p>
    </div>
<?php endif ?>
<div class="admin-wrapper">
    <a href="#" class="btn btn-primary new-article">Ajouter un article</a>
    <section class="post-listing">
        <div class="post-listing__header">
            <h3>#</h3>
            <h3>Titre</h3>
            <h3>Actions</h3>
        </div>
        <section class="post-listing__body">
            <?php foreach($posts as $post): ?>
            <div class="card-design admin-card">
                <h4 class="admin-card__id"><?= e($post->getID()) ?></h4>  
                <h3 class="admin-card__title"><a href="<?= $router->url('admin_post', ['id' => $post->getID()]) ?>"><?= e($post->getName()) ?></a></h3>
                <div class="admin-card__option">
                    <a href="<?= $router->url('admin_post', ['id' => $post->getID()]) ?>" class="btn btn-primary">Éditer</a>
                    <form style="display: inline;" method="POST" action="<?= $router->url('admin_post_delete', ['id' => $post->getID()]) ?>" onsubmit="return confirm('Voulez vous vraiment supprimer l\'article ?')">
                        <button type="submit" class="btn btn-alert">Supprimer</button>
                    </form>
                </div>
            </div>  
            <?php endforeach ?>
        </section
    </section>
    <div class="footer-links">
        <?= $pagination->previousLink($link) ?>
        <?= $pagination->nextLink($link) ?>
    </div>
</div>



