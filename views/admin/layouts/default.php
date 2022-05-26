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
    <meta content="noindex">
    <title>Solidarité | <?= isset($pageTitle) ? e($pageTitle) : 'Blog' ?></title>
    <link rel="shortcut icon" href="/img/svg/logo/favicon.svg">
    <link rel="stylesheet" href="/css/style.css">
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
                        Articles
                    </a></h4>
            </li>
            <li>
                <h4><a href="<?= $router->url('admin_categories') ?>">
                        <svg>
                            <use xlink:href="/img/svg/sprite.svg#category-title"></use>
                        </svg>
                        Catégories
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
            <li>
                <h4><a href="<?= $router->url('admin_guide') ?>">
                        <svg>
                            <use xlink:href="/img/svg/sprite.svg#guide"></use>
                        </svg>
                        Guide
                    </a></h4>
            </li>
        </ul>
        <ul class="header-side">
            <li class="header__logout">
                <form action="<?= $router->url('logout', ['token' => $_SESSION['token']]) ?>" method="POST">
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
    <footer class="page-footer">
        <svg id="goTopButton" width="48px" height="48px" viewBox="0 0 48 48" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path d="M39.6339 31.8839C39.1457 32.372 38.3543 32.372 37.8661 31.8839L24 18.0178L10.1339 31.8839C9.64573 32.372 8.85427 32.372 8.36612 31.8839C7.87796 31.3957 7.87796 30.6043 8.36612 30.1161L23.1161 15.3661C23.6043 14.878 24.3957 14.878 24.8839 15.3661L39.6339 30.1161C40.122 30.6043 40.122 31.3957 39.6339 31.8839Z"/>
        </svg>
        <h2 class="section-title">Vous êtes sur le panel admin du site solid<strong>ARU1</strong></h2>
        <ul class="footer-nav">
            <li class="first"><a href="<?= $router->url('home') ?>">Accueil</a></li>
            <li><a href="<?= $router->url('contact') ?>">Contact</a></li>
        </ul>
        <div class="RGPD-container flex-center">
            <div class="theme-switcher-container">
                <div class="theme-switcher form-switch container">
                    <label for="theme-switcher">
                        <input type="checkbox" id="theme-switcher" name="theme-switcher" value="1" aria-label="Changer le thème" checked>
                        <span class="switch"></span>
                    </label>
                </div>
            </div>
            <p><a class="muted" href="<?= $router->url('rgpd') ?>">RGPD</a></p>
        </div>
    </footer>
</div>
<script src=<?= "/js/jquery-3.6.0.min.js" ?>></script>
<script src=<?= "/js/app.js" ?>></script>
<?= $afterBodyContent ?? '' ?>
</body>
</html>