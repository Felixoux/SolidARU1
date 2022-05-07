<!DOCTYPE html>
<html lang="fr" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name = "description" content= "Ceci est un site répertoriant tous les articles de l'ASBL les amis ARU1" >
    <meta name="keywords" content="ARU1 aru1 solidaru1 solidarité felixoux alwaysdata site">
    <meta name="google-site-verification" content="-UejOj4iwCE1xZZHO3O9gncUUfsEczIaQIitaMI3z-w" />
    <title>Solidarité | <?= isset($pageTitle) ? e($pageTitle) : 'Blog' ?></title>
    <link rel="shortcut icon" href="/img/svg/favicon.svg">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<div id="pre-loader" class="active flex-center">
    <div class="loader"></div>
</div>
<div class="page-wrapper relative">
    <nav class="header">
        <ul class="header-nav">
            <li class="header__home"><a class="underline" href="<?= $router->url('home') ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 12 12" fill="#EBF1FF" id="home">
                        <path fill="currentColor" d="M0 4v7a1 1 0 001 1h3V8h4v4h3a1 1 0 001-1V4L6 0 0 4z"></path>
                    </svg></a></li>
            <li><h4>
                    <a href="<?= $router->url('home') ?>#event">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="#D4DCFF"
                             width="512.000000pt" height="512.000000pt" viewBox="0 0 512.000000 512.000000"
                             preserveAspectRatio="xMidYMid meet">

                            <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)"
                                stroke="none">
                                <path d="M361 5109 c-172 -34 -318 -182 -351 -358 -14 -74 -14 -4308 0 -4382
34 -180 179 -325 359 -359 74 -14 4308 -14 4382 0 180 34 325 179 359 359 14
74 14 4308 0 4382 -34 180 -179 325 -359 359 -67 12 -4325 12 -4390 -1z m4379
-309 c26 -13 47 -34 60 -60 19 -37 20 -58 20 -430 l0 -390 -2260 0 -2260 0 0
390 c0 372 1 393 20 430 12 24 35 47 58 59 36 20 66 20 2180 21 2128 0 2143 0
2182 -20z m80 -2780 c0 -1585 0 -1601 -20 -1640 -13 -26 -34 -47 -60 -60 -39
-20 -54 -20 -2180 -20 -2126 0 -2141 0 -2180 20 -26 13 -47 34 -60 60 -20 39
-20 55 -20 1640 l0 1600 2260 0 2260 0 0 -1600z"/>
                                <path d="M678 4499 c-43 -22 -78 -81 -78 -129 0 -76 74 -150 150 -150 76 0
150 74 150 150 0 50 -35 107 -80 130 -49 25 -94 25 -142 -1z"/>
                                <path d="M1278 4499 c-43 -22 -78 -81 -78 -129 0 -50 35 -107 80 -130 21 -11
53 -20 70 -20 76 0 150 74 150 150 0 50 -35 107 -80 130 -49 25 -94 25 -142
-1z"/>
                                <path d="M1878 4499 c-43 -22 -78 -81 -78 -129 0 -50 35 -107 80 -130 21 -11
53 -20 70 -20 76 0 150 74 150 150 0 50 -35 107 -80 130 -49 25 -94 25 -142
-1z"/>
                                <path d="M678 3299 c-23 -12 -46 -35 -58 -59 -19 -38 -20 -58 -20 -680 0 -622
1 -642 20 -680 13 -26 34 -47 60 -60 38 -20 57 -20 820 -20 763 0 782 0 820
20 26 13 47 34 60 60 19 38 20 58 20 680 0 622 -1 642 -20 680 -13 26 -34 47
-60 60 -38 20 -57 20 -822 20 -760 -1 -784 -1 -820 -21z m1422 -739 l0 -460
-600 0 -600 0 0 460 0 460 600 0 600 0 0 -460z"/>
                                <path d="M2778 2689 c-43 -22 -78 -81 -78 -129 0 -50 35 -107 80 -130 38 -20
57 -20 830 -20 773 0 792 0 830 20 45 23 80 80 80 130 0 50 -35 107 -80 130
-38 20 -57 20 -832 20 -770 -1 -794 -1 -830 -21z"/>
                                <path d="M2778 2079 c-43 -22 -78 -81 -78 -129 0 -50 35 -107 80 -130 38 -20
57 -20 830 -20 773 0 792 0 830 20 45 23 80 80 80 130 0 50 -35 107 -80 130
-38 20 -57 20 -832 20 -770 -1 -794 -1 -830 -21z"/>
                                <path d="M678 1479 c-43 -22 -78 -81 -78 -129 0 -50 35 -107 80 -130 39 -20
55 -20 1880 -20 1825 0 1841 0 1880 20 45 23 80 80 80 130 0 50 -35 107 -80
130 -39 20 -54 20 -1882 20 -1815 -1 -1844 -1 -1880 -21z"/>
                                <path d="M678 879 c-43 -22 -78 -81 -78 -129 0 -50 35 -107 80 -130 39 -20 55
-20 1880 -20 1825 0 1841 0 1880 20 45 23 80 80 80 130 0 50 -35 107 -80 130
-39 20 -54 20 -1882 20 -1815 -1 -1844 -1 -1880 -21z"/>
                            </g>
                        </svg>Blog
                    </a>
            </h4></li>
            <li><h4>
                    <a href="#"><svg fill="#D4DCFF" height="325pt" viewBox="0 0 325 325.37515" width="325pt" xmlns="http://www.w3.org/2000/svg"><path d="m114.6875 284.675781-73.800781-73.800781 178.5-178.5 73.800781 73.800781zm-80.699219-60.800781 67.699219 67.699219-101.5 33.800781zm281.898438-140.300781-12.800781 12.800781-73.898438-73.898438 12.800781-12.800781c12.894531-12.902343 33.804688-12.902343 46.699219 0l27.199219 27.199219c12.800781 12.9375 12.800781 33.765625 0 46.699219zm0 0"/>
                        </svg>A propos
                    </a>
            </h4></li>
            <li><h4>
                    <a href="#">
                        <svg fill="#D4DCFF" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 29 31.41"><path d="M1.05 1.51L6.94.04c.64-.16 1.3.2 1.56.85l2.72 6.87c.24.6.08 1.31-.39 1.72L7.4 12.52c2.04 4.7 5.6 8.62 10.04 10.87l2.81-3.72c.39-.51 1.03-.68 1.59-.42l6.34 2.94c.61.29.94 1 .79 1.69l-1.36 6.38c-.14.66-.69 1.14-1.33 1.14C11.78 31.41 0 18.68 0 2.95c0-.69.44-1.29 1.05-1.44z"/>
                        </svg>Contact
                    </a>
            </h4></li>
        </ul>
        <ul class="header-side flex">
            <li class="header__search">
                <button>
                    <svg fill="#EBF1FF" xmlns="http://www.w3.org/2000/svg"
                         width="18" height="18" viewBox="0 0 512.000000 512.000000"
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
            </li>
            <li class="header__burger">
                <button id="js-burger">
                    <span>Afficher le menu</span>
                </button>
            </li>
        </ul>
    </nav>
    <?=
    /** @var string $content */
    $content
    ?>

</div>
<script src=<?= "/js/jquery-3.6.0.min.js" ?>></script>
<script src=<?= "/js/app.js" ?>></script>
</body>
</html>


