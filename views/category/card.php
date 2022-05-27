<article class="card card--category">
    <?php
    $link_image = UPLOAD_PATH . DIRECTORY_SEPARATOR .'categories' . DIRECTORY_SEPARATOR . $category->getImage() . '_' . 'small' . '.jpg';
    ?>
    <?php if ($category->getImage() && file_exists($link_image)): ?>
        <div class="wrap-img-card">
            <img src="<?= $category->getImageURL('small') ?>" alt="<?= (new \App\Helpers\Text())::noExt($category->getImageURL('small')) ?>">
        </div>
    <?php endif ?>
    <div class="card__body stack">
        <div class="card__header">
            <h2 class="card__title"><?= $category->getName() ?></h2>
            <?= App\Helper::svg('category_card', 'card__svg') ?>
        </div>

        <div class="card__description muted-text">
            <p>
                <?php if ($category->getImage()): ?> <!--There is less text is image is on the card-->
                <?= $category->getExerpt(150) ?>
                <?php else: ?>
                <?= $category->getExerpt(380) ?>
                <?php endif ?>
            </p>
        </div>
        <a href="<?= $router->url('category', ['id' => $category->getID(), 'slug' => $category->getSlug()]) ?>"
           class="card__link" title="<?= $category->getName() ?>">
        </a>

    </div>
    <div class="card__footer flex flex-start" style="border-color:<?= $color ?>">
        <p><?= $numberPost ?> article<?= $numberPost > 1 ? 's' : '' ?></p>
        <p style="margin-left: auto"><?= $category->getCreatedAt()->format('d/m/Y') ?></p>
    </div>
</article>