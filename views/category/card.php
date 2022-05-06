<article class="card">
    <div class="card__body stack">
        <h2 class="card__title">
            <?= $category->getName() ?>
        </h2>
        <div class="card__description muted-text">
            <p>
                <?= $category->getExerpt(380) ?>
            </p>
        </div>
        <a href="<?= $router->url('category', ['id' => $category->getID(), 'slug' => $category->getSlug()]) ?>" class="card__link" title="<?= $category->getName() ?>"> </a>

    </div>
    <div class="card__footer flex flex-start">
        <p>19 Post(s)</p>
    </div>
</article>