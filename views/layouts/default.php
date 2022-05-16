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
    <meta name="description" content="Ceci est un site répertoriant tous les articles de l'ASBL les amis ARU1">
    <meta name="keywords" content="ARU1 aru1 solidaru1 solidarité felixoux alwaysdata site">
    <meta name="google-site-verification" content="-UejOj4iwCE1xZZHO3O9gncUUfsEczIaQIitaMI3z-w"/>
    <title>Solidarité | <?= isset($pageTitle) ? e($pageTitle) : 'Blog' ?></title>
    <link rel="shortcut icon" href="/img/svg/logo/favicon.svg">
    <link rel="stylesheet" href="/css/style.css">
    <?= $beforeBodyContent ?? '' ?>
</head>
<body>
<div id="pre-loader" class="flex-center">
    <div class="loader"></div>
</div>
<nav class="header nav-down">
    <ul class="header-nav">
        <li class="header__home"><a class="underline" href="<?= $router->url('home') ?>">
                <svg id="home">
                    <use xlink:href="/img/svg//sprite.svg#home"></use>
                </svg>
            </a></li>
        <li id="blog-anchor">
            <h4>
                <a href="<?= $router->url('home') . '#event' ?>">
                    <svg>
                        <use xlink:href="/img/svg/sprite.svg#post"></use>
                    </svg>
                    Blog
                </a>
            </h4>
        </li>
        <li>
            <h4>
                <a href="#">
                    <svg>
                        <use xlink:href="/img/svg/sprite.svg#pen"></use>
                    </svg>
                    A propos
                </a>
            </h4>
        </li>
        <li>
            <h4>
                <a href="#">
                    <svg>
                        <use xlink:href="/img/svg/sprite.svg#phone"></use>
                    </svg>
                    Contact
                </a>
            </h4>
        </li>
        <?php if (App\Auth::is_connected() === true): ?>
            <li>
                <h4>
                    <a href="<?= $router->url('admin_posts') ?>">
                        <svg>
                            <use xlink:href="/img/svg/sprite.svg#admin"></use>
                        </svg>
                        Admin
                    </a>
                </h4>
            </li>
        <?php endif ?>
    </ul>
    <ul class="header-side flex">
        <li class="header__search" id="searchBtn">
            <button>
                <svg>
                    <use xlink:href="/img/svg/sprite.svg#search"></use>
                </svg>
            </button>
        </li>
        <li class="header__burger">
            <button id="js-burger">
                <span>Afficher le menu</span>
            </button>
        </li>
    </ul>
</nav>
<div class="search-container">
    <form method="GET" action="<?= $router->url('search') ?>" onsubmit="removeSearch()">
            <input class="addFocus" type="text" name="q" placeholder="Rechercher du contenu" autofocus autocomplete="off">
            <button type="submit">
                <svg>
                    <use xlink:href="/img/svg/sprite.svg#search"></use>
                </svg>
            </button>
    </form>
</div>
<div class="page-wrapper relative" style="margin-top: 110px;">
    <?=
    /** @var string $content */
    $content
    ?>
<div class="theme-switcher-title mb2 mt3 container">Thème</div>
    <div class="theme-switcher form-switch mb3 container">
        <input type="checkbox" id="theme-switcher" name="theme-switcher" value="1" aria-label="Changer le thème"
               checked>
        <label for="theme-switcher">
            <span class="switch"></span>
        </label>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src=<?= "/js/jquery-3.6.0.min.js" ?>></script>
<script src=<?= "/js/app.js" ?>></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<?= $afterBodyContent ?? '' ?>
</body>
</html>


