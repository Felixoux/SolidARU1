<?php

use App\{Auth, Connection, Table\CategoryTable};

require ROOT_PATH . '/vendor/autoload.php';
Auth::check();
$pageTitle = 'Gestion des catégories';
$pdo = Connection::getPDO();
$link = $router->url('admin_categories');
$items = (new CategoryTable($pdo))->all();
?>
<?php if (isset($_GET['delete'])): ?>
    <p class="alert alert-success">La catégorie a bien été supprimé</p>
<?php endif ?>
<?php if (isset($_GET['created'])): ?>
    <p class="alert alert-success">La catégorie a bien été créé</p>
<?php endif ?>
    <section class="post-listing">
        <div class="post-listing__header">
            <h3>#</h3>
            <h3>Titre</h3>
            <a href="<?= $router->url('admin_category_new') ?>" class="btn btn-primary new-article">Ajouter une catégorie</a>
        </div>
        <section class="post-listing__body">
            <?php foreach ($items as $item): ?>
                <div class="card-design admin-card">
                    <h4 class="admin-card__id"><?= e($item->getID()) ?></h4>
                    <h4 class="admin-card__title"><a
                                href="<?= $router->url('admin_category', ['id' => $item->getID()]) ?>"><?= e($item->getName()) ?></a>
                    </h4>
                    <div class="admin-card__option">
                        <a href="<?= $router->url('admin_category', ['id' => $item->getID()]) ?>"
                           class="btn btn-primary">Éditer</a>
                        <form style="display: inline;" method="POST"
                              action="<?= $router->url('admin_category_delete', ['id' => $item->getID()]) ?>"
                              onsubmit="return confirm('Voulez vous vraiment supprimer la catégorie ?')">
                            <button type="submit" class="btn btn-alert">Supprimer</button>
                        </form>
                    </div>
                </div>
            <?php endforeach ?>
        </section
    </section>




