<!DOCTYPE html>
<html lang="fr" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solidarité | <?= htmlentities($pageTitle) ?? 'Home' ?></title>
    <link rel="shortcut icon" href="img/svg/logo.svg">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<div class="page-wrapper relative">
    <nav class="header flex">
        <ul class="header__nav flex">
            <li><h4><a class="underline" href="#">Accueil</a></h4></li>
            <li><h4><a href="/blog#event">Blog</a></h4></li>
            <li><h4><a href="#">A propos</a></h4></li>
            <li><h4><a href="#">Contact</a></h4></li>
        </ul>
        <ul class="header__side flex">
            <li>
                <div class="search-button">
                    <button>
                        <svg version="1.0" xmlns="http://www.w3.org/2000/svg"
                        width="20" height="20" viewBox="0 0 512.000000 512.000000"
                        preserveAspectRatio="xMidYMid meet">

                        <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)"
                        stroke="none">
                        <path d="M1851 5109 c-657 -74 -1219 -432 -1555 -989 -138 -229 -223 -463
                        -273 -745 -26 -151 -23 -500 5 -655 120 -657 508 -1187 1087 -1487 310 -160
                        591 -228 945 -227 431 0 785 107 1145 345 l119 79 696 -693 c469 -468 708
                        -700 735 -713 54 -25 167 -25 215 0 120 63 175 193 135 317 -17 51 -54 91
                        -717 755 l-699 701 77 114 c371 548 453 1234 222 1869 -75 208 -219 450 -375
                        631 -260 300 -628 533 -1005 634 -230 62 -542 89 -757 64z m357 -510 c380 -41
                        677 -182 943 -448 271 -271 415 -579 451 -963 32 -343 -60 -693 -263 -998 -84
                        -127 -282 -325 -409 -409 -512 -341 -1143 -359 -1664 -47 -376 224 -641 602
                        -728 1039 -32 160 -32 414 0 574 90 451 367 835 767 1062 267 152 604 223 903
                        190z"/>
                        </g>
                        </svg>
                    </button>
                </div>
            </li>
            <li>
                <button id="js-burger" >
                    <span>Afficher le menu</span>
                </button>
            </li>
        </ul>
    </nav>
    <div class="triangle-shape mobile-hidden"></div>
    <?= $content ?>
    <footer>
        <!-- <div class="container">
            <?php if(defined('DEBUG_TIME')) : ?>
                Page générée en <?= round(1000 * (microtime(true) - DEBUG_TIME)) ?> ms
            <?php endif ?> 
        </div> -->
    </footer>
</div>
<script src="js/app.js"></script>
</body>
</html>