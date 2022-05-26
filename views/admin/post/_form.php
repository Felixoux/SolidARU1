<section class="mt4">
    <p class="alert mb3">* champs requis</p>
    <a class="underline mt3" href="<?= $router->url('admin_guide') . "#md-guide" ?>">Guide d'écriture simplifié (pour le contenu
        uniquement)</a>
    <form action="" method="POST" enctype="multipart/form-data" class="grid-form mt3">
        <?= $form->input('name', 'Titre', 'withSpace', 'required') ?>
        <?= $form->input('slug', 'URL', 'withDash', 'required') ?>
        <div class="content-form">
            <?= $form->textarea('content', 'Contenu') ?>
        </div>
        <div class="content-post">
        <?= $form->select('categories_ids', 'Catégories', $categories, 'required', 'category-control') ?>
            <div class="thumbnail-form">
            <?= $form->file('image', 'Image à la une') ?>
            <?php $link = UPLOAD_PATH . DIRECTORY_SEPARATOR .'posts' . DIRECTORY_SEPARATOR . $post->getImage() . '_' . 'small' . '.jpg'; ?>
            <?php if ($post->getImage() && file_exists($link)): ?>
                <img  src="<?= $post->getImageURL('small') ?>" alt="<?= $post->getImageURL('small') ?>" width="200" height="120">
            <?php endif ?>
            </div>
        </div>
        <?= $form->select('images_ids', 'Images', $images) ?>
        <?= $form->select('files_ids', 'Documents', $files) ?>
        <?= $form->input('created_at', 'Date de publication', 'datepicker') ?>
        <?php if ($post->getID() !== null): ?>
        <div class="danger-zone">
            <h4 class="alert mb1">Zone danger</h4>
            <a class="btn-alert mr2 mb2" href="<?= $router->url('post_thumbnail_delete', ['id' => $post->getID(), 'token' => $_SESSION['token']]) ?>">Supprimer l'image à la une</a>
            <a class="btn-alert mr2 mb2" href="<?= $router->url('post_images_detach', ['id' => $post->getID(), 'token' => $_SESSION['token']]) ?>">Dissocier les images</a>
            <a class="btn-alert" href="<?= $router->url('post_files_detach', ['id' => $post->getID(), 'token' => $_SESSION['token']]) ?>">Dissocier les documents</a>
        </div>
        <?php endif ?>
        <button type="submit" class="btn-primary">
            <?php if ($post->getID() !== null): ?>
                Modifier
            <?php else: ?>
                Créer
            <?php endif ?>
        </button>
    </form>
</section>
