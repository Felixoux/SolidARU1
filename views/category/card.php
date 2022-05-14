<article class="card card--category">

    <?php if ($category->getImage()): ?>
        <img src="<?= $category->getImageURL('small') ?>" alt="">
    <?php endif ?>
    <div class="card__body stack">
        <div class="card__header">
            <h2 class="card__title"><?= e($category->getName()) ?></h2>
            <svg class="card__svg">
                <use xlink:href="/img/svg/sprite.svg#category_card"></use>
            </svg>
        </div>

        <div class="card__description muted-text">
            <p>
                <?= $category->getExerpt(380) ?>
            </p>
        </div>
        <a href="<?= $router->url('category', ['id' => $category->getID(), 'slug' => $category->getSlug()]) ?>"
           class="card__link" title="<?= e($category->getName()) ?>"> </a>

    </div>
    <div class="card__footer flex flex-start">
        <p>Il y a <?= $numberPost ?> post(s)</p>
    </div>
</article>