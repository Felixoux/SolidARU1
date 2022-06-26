<?php
App\Helper::sessionStart();
use App\{Connection, Model\Post};

$pageTitle = 'recherche';
$_SESSION['category_link'] = "false";

if (!empty($_GET['q'])) {
    $q = e($_GET['q']);
    if ($q === "chainette" || $q === "Chainette") {
        header('Location: https://www.youtube.com/watch?v=PaGS-lB1z3E');
        exit();
    }
    $pdo = Connection::getPDO();
    $keyWords = explode(' ', $q);
    $sql = 'SELECT * FROM post';
    $i = 0;
    foreach ($keyWords as $keyWord) {
        if (strlen($keyWord) > 3) {
            if ($i === 0) {
                $sql .= " WHERE ";
            } else {
                $sql .= " OR ";
            }
            $sql .= "content LIKE '%$keyWord%'";
            $i++;
        }
    }
    $sql .= " ORDER BY created_at DESC";
    $query = $pdo->query($sql);
    $count = $pdo->query($sql)->rowCount(); // Number of results
    $posts = $query->fetchAll(PDO::FETCH_CLASS, Post::class);
// catego
    $sql = 'SELECT * FROM category';
    $i = 0;
    foreach ($keyWords as $keyWord) {
        if (strlen($keyWord) > 3) {
            if ($i === 0) {
                $sql .= " WHERE ";
            } else {
                $sql .= " OR ";
            }
            $sql .= "content LIKE '%$keyWord%'";
            $i++;
        }
    }
    $sql .= " ORDER BY created_at DESC";
    $query = $pdo->query($sql);
    $countCategories = $pdo->query($sql)->rowCount(); // Number of results
    $categories = $query->fetchAll(PDO::FETCH_CLASS, Post::class);
}
?>
<div class="page-header search-header container">
    <?php
    $plural = null;
    if (isset($count) && $count > 1) {
        $plural = 's';
    }

    $pluralCategories = null;
    if (isset($countCategories) && $countCategories > 1) {
        $pluralCategories = 's';

    }
    ?>
    <h1 class="big-title"><?= $count ?? "Aucun" ?> résultat<?= isset($plural) ? 's' : '' ?></h1>
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
</div>
<section class="search-result">
    <?php if (isset($posts) && !empty($posts)) {

        echo <<<HTML
        <h2 class="section-title">Article{$plural} trouvé{$plural}</h2>
        <hr>
HTML;
        foreach ($posts as $post) {
            $i = 0;
            foreach ($keyWords as $keyWord) {
                $i++;
                $content = str_ireplace($keyWord, '<strong>' . $keyWord . '</strong>', $post->getcontent());
            }
            $content = (new \App\Helpers\Text())::parseDown($content);
            $content = (new \App\Helpers\Text())::exerpt($content, 350);
            $link = $router->url('post', ['id' => $post->getID(), 'slug' => $post->getSlug()]);
            echo <<<HTML
            <article class="card stack p3 my4">
                <div class="header-post flex">
                    <h3 class="medium-title">{$post->getName()}</h3>
                    <p class="muted">{$post->getCreatedAt()->format('d/m/Y')}</p>
                </div>
                <p>{$content}</p>
                <p class="mt3"><a  href="{$link}" class="button">Voir le post</a></p>
            </article>
HTML;
        }
        echo <<<HTML
        <h2 class="section-title">Catégorie{$pluralCategories} trouvée{$pluralCategories}</h2>
        <hr>
HTML;
        foreach ($categories as $category) {
            $i = 0;
            foreach ($keyWords as $keyWord) {
                $i++;
                $content = str_ireplace($keyWord, '<strong>' . $keyWord . '</strong>', $category->getcontent());
            }
            $content = (new \App\Helpers\Text())::parseDown($content);
            $content = (new \App\Helpers\Text())::exerpt($content, 350);
            $link = $router->url('category', ['id' => $category->getID(), 'slug' => $category->getSlug()]);
            echo <<<HTML
            <article class="card stack p3 my4">
                <div class="header-post flex">
                    <h3 class="medium-title">{$category->getName()}</h3>
                    <p class="muted">{$category->getCreatedAt()->format('d/m/Y')}</p>
                </div>
                <p>{$content}</p>
                <p class="mt3"><a  href="{$link}" class="button">Voir la catégorie</a></p>
            </article>
HTML;
        }
    }
    ?>
</section>
