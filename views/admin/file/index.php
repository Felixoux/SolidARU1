<?php

use App\{Auth, Connection, Table\FileTable};

require ROOT_PATH . '/vendor/autoload.php';
Auth::check();
$pageTitle = 'Gestion des images';
$pdo = Connection::getPDO();

[$items, $pagination] = (new FileTable($pdo))->findPaginated();
$link = $router->url('admin_files');
?>
<?php if (isset($_GET['delete'])): ?>
    <p class="alert alert-success">Document supprimée avec succès</p>
<?php endif ?>
<?php if (isset($_GET['created'])): ?>
    <p class="alert alert-success">Document(s) ajoutée(s) avec succès</p>
<?php endif ?>
<h2 class="medium-title mt2">Page document</h2>
<hr>
<section class="post-listing fill-page">
    <div class="post-listing__header">
        <h3 class="section-title">#</h3>
        <h3 class="section-title">Titre</h3>
        <a href="<?= $router->url('admin_file_new') ?>" class="btn btn-secondary new-article">Ajouter des documents</a>
    </div>
    <section class="post-listing__body">
        <?php foreach ($items as $item): ?>
            <div class="card-design admin-card">
                <h4 class="admin-card__id"><?= $item->getID() ?></h4>
                <h4 class="admin-card__title"><?= e($item->getName()) ?></h4>
                <div class="admin-card__option">
                    <form style="display: inline;" method="POST"
                          action="<?= $router->url('admin_file_delete', ['id' => $item->getID()]) ?>"
                          onsubmit="return confirm('Voulez vous vraiment supprimer le document ?')">
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


