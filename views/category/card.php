<article class="card card-article">
    <div class="card__body stack">
        <h4 class="card__title">
            <?= $category->getName() ?>
        </h4>
        <p class="card__content">
            <?= $category->getExerpt(250) ?>
        </p>
    </div>
    <div class="card__footer">
        <a href="<?= $router->url('category', ['slug' => $category->getSlug()]) ?>"><button class="btn btn-swap f-right">Bouton</button></a>
    </div>
</article>   