<?php
App\Helper::sessionStart();
App\Auth::remember();
?>
<!DOCTYPE html>
<html lang="fr" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solidarité | <?= isset($pageTitle) ? e($pageTitle) : 'Blog' ?></title>
    <link rel="shortcut icon" href="/img/svg/logo/favicon.svg">
    <link rel="stylesheet" href="/css/style.css">
    <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css"> MARKDOWN EDITOR -->
    <?= $beforeBodyContent ?? '' ?>
</head>
<body>
<div id="pre-loader" class="active flex-center">
    <div class="loader"></div>
</div>
<div class="page-wrapper relative">
    <nav class="header header-admin">
        <ul class="header-nav">
            <li class="header__home"><a class="underline" href="<?= $router->url('home') ?>">
                    <svg>
                        <use xlink:href="/img/svg/sprite.svg#home"></use>
                    </svg>
                </a></li>
            <li>
                <h4><a href="<?= $router->url('admin_posts') ?>">
                        <svg>
                            <use xlink:href="/img/svg/sprite.svg#post"></use>
                        </svg>
                        Posts
                    </a></h4>
            </li>
            <li>
                <h4><a href="<?= $router->url('admin_categories') ?>">
                        <svg>
                            <use xlink:href="/img/svg/sprite.svg#category-title"></use>
                        </svg>
                        Catégorie
                    </a></h4>
            </li>
            <li>
                <h4><a href="<?= $router->url('admin_images') ?>">
                        <svg>
                            <use xlink:href="/img/svg/sprite.svg#image"></use>
                        </svg>
                        Images
                    </a></h4>
            </li>
            <li>
                <h4><a href="<?= $router->url('admin_files') ?>">
                        <svg>
                            <use xlink:href="/img/svg/sprite.svg#document"></use>
                        </svg>
                        Documents
                    </a></h4>
            </li>
            <li>
                <h4><a href="<?= $router->url('security') ?>">
                        <svg>
                            <use xlink:href="/img/svg/sprite.svg#lock"></use>
                        </svg>
                        Sécurité
                    </a></h4>
            </li>
        </ul>
        <ul class="header-side">
            <li class="header__logout">
                <form action="<?= $router->url('logout') ?>" method="POST">
                    <button type="submit">
                        <svg>
                            <use xlink:href="/img/svg/sprite.svg#logout"></use>
                        </svg>
                    </button>
                </form>
            </li>
            <li class="header__burger">
                <button id="js-burger">
                    <span>Afficher le menu</span>
                </button>
            </li>
        </ul>
    </nav>
    <div class="container my4">
        <?= $content ?>
    </div>
</div>
<script src=<?= "/js/jquery-3.6.0.min.js" ?>></script>
<script src=<?= "/js/app.js" ?>></script>
<?= $afterBodyContent ?? '' ?>
<!--<script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script> MARKDOWN EDITOR  -->
</body>
</html>






