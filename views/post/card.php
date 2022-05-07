<article class="card">
    <?php if ($post->getImage()): ?>
        <img src="<?= $post->getImageURL('small') ?>" alt="">
    <?php endif ?>
    <div class="card__body stack">

        <h2 class="card__title">
                <?= $post->getName() ?>
        </h2>
        <div class="card__description muted-text">
            <p>
                <?= $post->getExerpt(300) ?>
            </p>
        </div>
        <a href="<?= $router->url('post', ['id' => $post->getID(), 'slug' => $post->getSlug()]) ?>" class="card__link" title="<?= $post->getName() ?>"></a>
    </div>
</article>