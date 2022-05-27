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
    <meta name="description" content="<?= isset($pageSummary) ? e($pageSummary) : 'Ceci est un site répertoriant tous les articles de l\'ASBL les amis ARU1' ?>">
    <meta name="keywords" content="ARU1 aru1 solidaru1 solidarité felixoux alwaysdata site">
    <meta name="google-site-verification" content="-UejOj4iwCE1xZZHO3O9gncUUfsEczIaQIitaMI3z-w"/>
    <title>Solidarité | <?= isset($pageTitle) ? e($pageTitle) : 'Blog' ?></title>
    <link rel="shortcut icon" href="/img/favicon.ico">
    <link rel="stylesheet" href="/css/style.css">
    <?= $beforeBodyContent ?? '' ?>
</head>
<body>
<div id="pre-loader" class="flex-center">
    <div class="loader"></div>
</div>
<?php
$navbar = new \App\HTML\Navbar($router);
$nav_links = [
    'Blog/post' => 'home',
    'A propos/pen' => 'about',
    'Contact/phone' => 'contact'
];
echo($navbar->getTop());
foreach ($nav_links as $name => $link) {
    echo($navbar->getLi($name, $link));
}
echo($navbar->getAdminLink());
echo($navbar->getBottom());
?>

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
<div class="page-wrapper relative">
    <?= $content ?>
    <?php require 'footer.php' ?>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src=<?= "/js/jquery-3.6.0.min.js" ?>></script>
<script src=<?= "/js/app.js" ?>></script>
<?= $afterBodyContent ?? '' ?>
</body>
</html>