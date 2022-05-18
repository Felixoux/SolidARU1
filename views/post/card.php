<article class="card">
    <?php if ($post->getImage()): ?>
        <div class="wrap-img-card">
            <img src="<?= $post->getImageURL('small') ?>" alt="">
        </div>
    <?php endif ?>
    <div class="card__body stack">

        <h2 class="card__title">
            <?= $post->getName() ?>
        </h2>
        <div class="card__description muted-text">
            <p>
                <?= $post->getExerpt(300) ?? $content ?>
            </p>
        </div>
        <a href="<?= $router->url('post', ['id' => $post->getID(), 'slug' => $post->getSlug()]) ?>" class="card__link"
           title="<?= $post->getName() ?>"></a>
    </div>
</article>