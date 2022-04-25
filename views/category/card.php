<article class="card card-exerpt card-article">
    <div class="card__body stack">
        <h4 class="card__title">
            <?= $category->getName() ?>
        </h4>
        <p class="card__content">
            <?= $category->getExerpt(250) ?>
        </p>
    </div>
    <div class="card__footer">
        <a href="<?= $router->url('category', ['id' => $category->getID(), 'slug' => $category->getSlug()]) ?>"><button class="btn btn-swap f-right">Voir plus</button></a>
    </div>
</article>   