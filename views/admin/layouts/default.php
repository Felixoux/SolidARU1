<!DOCTYPE html>
<html lang="fr" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solidarité | <?= isset($pageTitle) ? e($pageTitle) : 'Blog' ?></title>
    <link rel="shortcut icon" href="img/svg/logo.svg">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<div class="page-wrapper relative">
    <nav class="header flex">
        <ul class="header__nav flex">
            <li><h4><a href="<?= $router->url('home') ?>">Accueil</a></h4></li>
            <li><h4><a href="<?= $router->url('admin_posts') ?>">Posts</a></h4></li>
            <li><h4><a href="<?= $router->url('admin_categories') ?>">Catégorie</a></h4></li>
            <li><h4><a href="<?= $router->url('security') ?>">Sécurité</a></h4></li>
        </ul>
        <ul class="header__side flex">
            <li>
                <h4>
                    <form action="<?= $router->url('logout') ?>" method="POST" style="display: inline">
                        <button class="nav__link" type="submit">Se déconnecter</button>
                    </form>
                </h4>
            </li>
            <li>
                <button id="js-burger">
                    <span>Afficher le menu</span>
                </button>
            </li>
        </ul>
    </nav>
    <div class="container big-section">
        <?= $content ?>
    </div>
    <footer>
        <!-- <div class="container">
            <?php if (defined('DEBUG_TIME')) : ?>
                Page générée en <?= round(1000 * (microtime(true) - DEBUG_TIME)) ?> ms
            <?php endif ?>
        </div> -->
    </footer>
</div>
<script src=<?= "/js/app.js" ?>></script>
</body>
</html>