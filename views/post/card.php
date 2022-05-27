<article class="card card--post">
    <?php $link_image = UPLOAD_PATH . DIRECTORY_SEPARATOR .'posts' . DIRECTORY_SEPARATOR . $post->getImage() . '_' . 'small' . '.jpg'; ?>
    <?php if ($post->getImage() && file_exists($link_image)): ?>
        <div class="wrap-img-card">
            <img src="<?= $post->getImageURL('small') ?>" alt="<?= (new \App\Helpers\Text())::noExt($post->getImageURL('small')) ?>">
        </div>
    <?php endif ?>
    <div class="card__body stack">

        <h2 class="card__title">
            <?= $post->getName() ?>
        </h2>
        <div class="card__description muted-text">
            <p>
                <?php if ($post->getImage()): ?>
                    <?= $post->getExerpt(150) ?>
                <?php else: ?>
                    <?= $post->getExerpt(380) ?>
                <?php endif ?>
            </p>
        </div>
        <a href="<?= $router->url('post', ['id' => $post->getID(), 'slug' => $post->getSlug()]) ?>" class="card__link"
           title="<?= $post->getName() ?>"></a>
    </div>
</article>