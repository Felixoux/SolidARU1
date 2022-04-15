<!DOCTYPE html>
<html lang="fr" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solidarité | <?= $pageTitle ?? 'Home' ?></title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <nav class="navbar flex">
        <div class="nav-links">
            <ul>
                <li><h4><a class="underline" href="#">Accueil</a></h4></li>
                <li><h4><a href="/blog#event">Blog</a></h4></li>
                <li><h4><a href="#">A propos</a></h4></li>
                <li><h4><a href="#">Contact</a></h4></li>
            </ul>
        </div>
        <div><a href="#">test</a></div>
    </nav>
    <?= $content ?>
    <footer>
        <!-- <div class="container">
            <?php if(defined('DEBUG_TIME')) : ?>
                Page générée en <?= round(1000 * (microtime(true) - DEBUG_TIME)) ?> ms
            <?php endif ?> 
        </div> -->
    </footer>
</body>
</html>