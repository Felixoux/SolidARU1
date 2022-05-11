<?php

use App\{Auth, Connection, Table\PostTable};

require ROOT_PATH . '/vendor/autoload.php';


Auth::check();
$pageTitle = 'Gestion des articles';
$pdo = Connection::getPDO();
$link = $router->url('admin_posts');
[$posts, $pagination] = (new PostTable($pdo))->findPaginated();
?>
<?php if (isset($_GET['delete'])): ?>
    <p class="alert alert-success">L'article a bien été supprimé</p>
<?php endif ?>
<?php if (isset($_GET['created'])): ?>
    <p class="alert alert-success">L'article a bien été créé</p>
<?php endif ?>
<?php if (isset($_GET['modified'])): ?>
    <p class="alert alert-success">L'article a bien été modifié</p>
<?php endif ?>
<h2 class="medium-title mt2">Page article</h2>
<hr>
<section class="post-listing">
    <div class="post-listing__header">
        <h3 class="mobile-hidden section-title">#</h3>
        <h3 class="mobile-hidden section-title">Titre</h3>
        <a href="<?= $router->url('admin_post_new') ?>" class="btn btn-secondary new-article">Ajouter un article</a>
    </div>
    <section class="post-listing__body">
        <?php foreach ($posts as $post): ?>
            <div class="card-design admin-card">
                <h4 class="admin-card__id mobile-hidden"><?= e($post->getID()) ?></h4>
                <h4 class="admin-card__title"><a
                            href="<?= $router->url('admin_post', ['id' => $post->getID()]) ?>"><?= e($post->getName()) ?></a>
                </h4>
                <div class="admin-card__option">
                    <a href="<?= $router->url('admin_post', ['id' => $post->getID()]) ?>"
                       class="btn-primary section-title">Éditer</a>
                    <form style="display: inline;" method="POST"
                          action="<?= $router->url('admin_post_delete', ['id' => $post->getID()]) ?>"
                          onsubmit="return confirm('Voulez vous vraiment supprimer l\'article ?')">
                        <button type="submit" class="btn btn-alert">Supprimer</button>
                    </form>
                </div>
            </div>
        <?php endforeach ?>
    </section>
</section>
<div class="footer-links">
    <?= $pagination->previousLink($link) ?>
    <?= $pagination->nextLink($link) ?>
</div>



