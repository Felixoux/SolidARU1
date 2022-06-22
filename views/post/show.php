<?php
App\Helper::sessionStart();
use App\{Connection, Helpers\Text, Model\Post, Table\PostTable};

$id = (int)$params['id'];
$slug = $params['slug'];
$pdo = Connection::getPDO();
$table = new PostTable($pdo);
/** @var Post|false */
$post = $table->find($id);

[$images, $files] = $table->getAttach($id);

if ($post === false) {
    header('location: ' . $router->url('e404'));
    exit();
}
$img_path =  UPLOAD_PATH . DIRECTORY_SEPARATOR . 'posts' . DIRECTORY_SEPARATOR . $post->getImage() . '_large.jpg';
$pageTitle = $post->getName();
$pageSummary = $post->getExerpt(150);

if ($post->getSlug() !== $slug) {
    $url = $router->url('post', ['slug' => $post->getSlug(), 'id' => $id]);
    http_response_code(301);
    header('Location: ' . $url);
    exit();
}
?>
<header class="article__header page-header flex" xmlns="http://www.w3.org/1999/html">
    <h1 class="article__title section-title">
        <?= Text::strong(3, $post->getName()) ?>
    </h1>
    <div class="flex">
        <svg class="mr2 card__svg mobile-hidden">
            <use xlink:href="/img/svg/sprite.svg#calendar"></use>
        </svg>
        <p class="muted mobile-hidden"><?= $post->getCreatedAt()->format("d/m/Y") ?></p>
    </div>
</header>
<section class="article">
    <div>
    <?php if(file_exists($img_path)): ?>
        <img class="article__img" src="<?= $post->getImageURL('large') ?>" alt="">
    <?php endif ?>
        <div class="article__content">
            <?= $post->getBody() ?>
            <?php if (!empty($files)): ?>
                <div class="article__files">
                    <hr>
                    <h3 class="medium-title mb3">Documents utiles :</h3>
                    <?php foreach ($files as $k => $file) {
                        $name = $file['name'];
                        $link = '/uploads/files' . DIRECTORY_SEPARATOR . $file['name'];
                        echo <<<HTML
            <p class="mb1">
                <a href="$link">$name</a>
            </p>
            HTML;
                    }
                    ?>
                </div>
            <?php endif ?>
        </div>
    </div>
    <footer class="article__footer" style="display: flex; justify-content: flex-end">
        <?php if(\App\Auth::is_connected() === true): ?>
        <a class="article__button btn-primary" href="<?= $router->url('admin_post', ['id' => $id]) ?>">
            <svg class="mr1 edit-svg">
                <use xlink:href="/img/svg/sprite.svg#edit"></use>
            </svg>
            Éditer
        </a>
        <?php endif ?>
        <?php if($_SESSION['category_link'] != "false"): ?>
        <a class="article__button btn-primary-outline ml3" href="<?= $_SESSION['category_link'] ?>">
            <svg class="mr1 edit-svg">
                <use xlink:href="/img/svg/sprite.svg#category_card"></use>
            </svg>
            Revenir à la catégorie
        </a>
        <?php else: ?>
        <a class="article__button btn-primary-outline ml3" href="<?= $router->url('home') ?>">
            <svg class="mr1 edit-svg">
                <use xlink:href="/img/svg/sprite.svg#home"></use>
            </svg>
            Revenir à l'accueil
        </a>
        <?php endif ?>
    </footer>
</section>
<?php if (!empty($images)): ?>
    <div class="carousel-container my5" style="background: var(--bg-card);border: 1px solid var(--border)">
        <?php foreach ($images as $k => $image) {
            $name = $image['name'];
            $link = $router->url('image') . "?name=" . $name . "&width=10&height=10";
            $altName = Text::noExt($name);
            echo <<<HTML
    <div class="blur-img">
        <img class="lazy" src="$link" alt="$altName" data-name="$name" width="500" loading="eager">
    </div>
HTML;
        }
        ?>
    </div>
<?php endif ?>
<?php
// Slick carousel
$css_slick = <<<HTML
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
HTML;
$beforeBodyContent = ob_before($css_slick);

$js_slick = <<<JS
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script>
    $(document).ready(function () {
    $('.carousel-container').slick({
    infinite: true,
    speed: 300,
    slidesToShow: 1
        })
             
    $('.slick-prev').html('&lt;')
    $('.slick-next').html('&gt;')
    })
</script>
JS;
$afterBodyContent = ob_after($js_slick);
