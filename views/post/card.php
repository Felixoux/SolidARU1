<article class="card card-article">
    <div class="card__body stack">
        <h4 class="card__title">
            <?= $post->getName() ?>
        </h4>
        <p class="card__content">
            <?= $post->getExerpt(250) ?>
        </p>
    </div>
    <div class="card__footer">
        <a href="<?= $router->url('post', ['id' => $post->getID(), 'slug' => $post->getSlug()]) ?>"><button class="btn btn-swap f-right">Voir plus</button></a>
    </div>
</article>   