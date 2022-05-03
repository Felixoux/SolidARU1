<article class="card">
    <div class="card__body stack">
        <h2 class="card__title">
            <?= $category->getName() ?>
        </h2>
        <div class="card__description muted-text">
            <p>
                <?= $category->getExerpt(300) ?>
            </p>
        </div>
        <a href="<?= $router->url('category', ['id' => $category->getID(), 'slug' => $category->getSlug()]) ?>" class="card__link"></a>
    </div>
</article>