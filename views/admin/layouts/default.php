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
<!-- Navbar construct -->
<?php
$navbar = new \App\HTML\Navbar($router, 'header-admin');
$nav_links = [
    'Articles/post' => 'admin_posts',
    'Catégories/category-title' => 'admin_categories',
    'Images/image' => 'admin_images',
    'Documents/document' => 'admin_files',
    'Sécurité/lock' => 'security',
    'Guide/guide' => 'admin_guide',
];
echo($navbar->getTop());
foreach ($nav_links as $name => $link) {
    echo($navbar->getLi($name, $link));
}
echo($navbar->getBottom());
?>
<div class="page-wrapper relative">
    <div class="container my4">
        <?= $content ?>
    </div>
    <?php require VIEW_PATH.DIRECTORY_SEPARATOR.'layouts'.DIRECTORY_SEPARATOR.'footer.php'; ?>
</div>
<script src=<?= "/js/jquery-3.6.0.min.js" ?>></script>
<script src=<?= "/js/app.js" ?>></script>
<?= $afterBodyContent ?? '' ?>
</body>
</html>