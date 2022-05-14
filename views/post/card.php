<article class="card">
    <?php if ($post->getImage()): ?>
        <img src="<?= $post->getImageURL('small') ?>" alt="">
    <?php endif ?>
    <div class="card__body stack">

        <h2 class="card__title">
            <?= e($post->getName()) ?>
        </h2>
        <div class="card__description muted-text">
            <p>
                <?= e($post->getExerpt(300)) ?>
            </p>
        </div>
        <a href="<?= $router->url('post', ['id' => $post->getID(), 'slug' => $post->getSlug()]) ?>" class="card__link"
           title="<?= e($post->getName()) ?>"></a>
    </div>
</article>