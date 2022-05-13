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
    <link rel="shortcut icon" href="/img/svg/favicon.svg">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<div id="pre-loader" class="flex-center">
    <div class="loader"></div>
</div>
<nav class="header nav-down">
    <ul class="header-nav">
        <li class="header__home"><a class="underline" href="<?= $router->url('home') ?>">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 12 12" fill="#EBF1FF" id="home">
                    <path fill="currentColor" d="M0 4v7a1 1 0 001 1h3V8h4v4h3a1 1 0 001-1V4L6 0 0 4z"></path>
                </svg>
            </a></li>
        <li>
            <h4>
                <a href="<?= $router->url('home') . '#event' ?>">
                    <svg>
                        <use xlink:href="/img/svg/svg-header-nav/sprite.svg#post"></use>
                    </svg>
                    Blog
                </a>
            </h4>
        </li>
        <li>
            <h4>
                <a href="#">
                    <svg>
                        <use xlink:href="/img/svg/svg-header-nav/sprite.svg#pen"></use>
                    </svg>
                    A propos
                </a>
            </h4>
        </li>
        <li>
            <h4>
                <a href="#">
                    <svg>
                        <use xlink:href="/img/svg/svg-header-nav/sprite.svg#phone"></use>
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
                            <use xlink:href="/img/svg/admin/sprite.svg#admin"></use>
                        </svg>
                        Admin
                    </a>
                </h4>
            </li>
        <?php endif ?>
    </ul>
    <ul class="header-side flex">
        <li class="header__search">
            <button>
                <svg>
                    <use xlink:href="/img/svg/svg-header-nav/sprite.svg#search"></use>
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
<div class="page-wrapper relative" style="margin-top: 110px;">
    <?=
    /** @var string $content */
    $content
    ?>
    <div class="theme-switcher-title ml5 mb2 mt3">Thème</div>
    <div class="theme-switcher ml5 form-switch mb3">
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
</body>
</html>


