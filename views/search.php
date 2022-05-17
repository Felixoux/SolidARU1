<?php

use App\Connection;
use App\Model\Post;


if(!empty($_GET['q'])) {
    $q = e($_GET['q']);
    $pdo = Connection::getPDO();
    $keyWords = explode(' ', $q);
    $sql = 'SELECT * FROM post';
    $i = 0;
    foreach ($keyWords as $keyWord) {
        if(strlen($keyWord) > 3) {
            if($i === 0) {
                $sql.= " WHERE ";
            } else {
                $sql.= " OR ";
            }
            $sql.= "content LIKE '%$keyWord%'";
            $i++;
        }
    }
    $query = $pdo->query($sql);
    $count = $pdo->query($sql)->rowCount(); // Number of results
    $posts = $query->fetchAll(PDO::FETCH_CLASS, Post::class);



}
?>
<!--<div class="page-header search-header container">
    <h1 class="big-title"><?/*= $count ?? '' */?> Résultats</h1>
    <div class="search-container">
        <form method="GET">
            <input autofocus type="text" name="q" placeholder="Rechercher du contenu" autocomplete="off">
            <button type="submit">
                <svg>
                    <use xlink:href="/img/svg/sprite.svg#search"></use>
                </svg>
            </button>
        </form>
    </div>
</div>-->
<section class="search-result">

    <?php if(isset($posts) && !empty($posts)) {
        echo <<<HTML
        <h2 class="section-title">Article(s) trouvé(s)</h2>
        <hr>
HTML;
        foreach ($posts as $post) {
            $content = $post->getContent();
            foreach ($keyWords as $keyWord) {
                $content = str_ireplace($keyWord, '<strong>' . $keyWord . '</strong>', $content);
               require VIEW_PATH . '/post/card.php';
            }
        }
    }
    ?>
</section>
