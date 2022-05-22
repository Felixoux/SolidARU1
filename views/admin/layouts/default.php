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
            <li>
                <h4><a href="<?= $router->url('admin_guide') ?>">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             width="512.000000pt" height="512.000000pt" viewBox="0 0 512.000000 512.000000"
                             preserveAspectRatio="xMidYMid meet">

                            <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)"
                               fill="currentColor" stroke="none">
                                <path d="M1105 5106 c-84 -21 -147 -57 -211 -121 -65 -65 -105 -136 -123 -223
-6 -31 -11 -159 -11 -307 l0 -255 -150 0 -150 0 0 -150 0 -150 150 0 150 0 0
-300 0 -300 -150 0 -150 0 0 -150 0 -150 150 0 150 0 0 -300 0 -300 -150 0
-150 0 0 -150 0 -150 150 0 150 0 0 -300 0 -300 -150 0 -150 0 0 -150 0 -150
150 0 150 0 0 -395 c0 -256 4 -413 11 -447 37 -172 175 -310 347 -347 38 -8
535 -11 1797 -11 l1745 0 0 2560 0 2560 -1752 -1 c-1368 -1 -1764 -3 -1803
-13z m3255 -2246 l0 -1960 -1622 -3 c-893 -2 -1635 -7 -1650 -11 l-28 -8 0
161 0 161 150 0 150 0 0 150 0 150 -150 0 -150 0 0 300 0 300 150 0 150 0 0
150 0 150 -150 0 -150 0 0 300 0 300 150 0 150 0 0 150 0 150 -150 0 -150 0 0
300 0 300 150 0 150 0 0 150 0 150 -150 0 -150 0 0 253 c1 285 4 300 76 343
l39 24 1593 0 1592 0 0 -1960z m0 -2410 l0 -150 -1591 0 -1591 0 -40 22 c-101
57 -102 194 -2 254 l39 24 1593 0 1592 0 0 -150z"/>
                                <path d="M2740 4045 c-8 -2 -49 -9 -90 -15 -358 -58 -694 -309 -862 -645 -89
-177 -122 -320 -123 -530 0 -163 11 -239 56 -377 97 -300 319 -557 607 -702
85 -43 216 -87 317 -107 103 -21 349 -18 455 5 423 91 768 399 899 804 44 136
56 215 56 372 0 83 -6 175 -14 215 -95 479 -451 849 -921 956 -78 18 -338 35
-380 24z m345 -325 c313 -81 560 -328 646 -645 18 -65 22 -107 22 -225 0 -118
-4 -160 -22 -225 -86 -317 -329 -561 -646 -646 -105 -29 -325 -32 -428 -6
-328 82 -580 328 -668 652 -32 115 -32 335 0 450 92 341 366 595 709 660 104
20 282 13 387 -15z"/>
                                <path d="M2710 3300 l0 -150 150 0 150 0 0 150 0 150 -150 0 -150 0 0 -150z"/>
                                <path d="M2710 2550 l0 -300 150 0 150 0 0 300 0 300 -150 0 -150 0 0 -300z"/>
                            </g>
                        </svg>
                        Guide
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
            <p><a class="muted" href="#">RGPD</a></p>
        </div>
    </footer>
</div>
<script src=<?= "/js/jquery-3.6.0.min.js" ?>></script>
<script src=<?= "/js/app.js" ?>></script>
<?= $afterBodyContent ?? '' ?>
</body>
</html>






