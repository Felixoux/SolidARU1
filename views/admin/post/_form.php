<section class="mt4">
    <p class="alert mb3">* champs requis</p>
    <a class="underline mt3" href="<?= $router->url('admin_guide') ?>">Guide d'écriture simplifié (pour le contenu
        uniquement)</a>
    <form action="" method="POST" enctype="multipart/form-data" class="grid-form mt3">
        <?= $form->input('name', 'Titre', 'withSpace', 'required') ?>
        <?= $form->input('slug', 'URL', 'withDash', 'required') ?>
        <div class="content-form">
            <?= $form->textarea('content', 'Contenu') ?>
        </div>
        <div class="content-post">
            <?= $form->select('categories_ids', 'Catégories', $categories, 'required', 'category-control') ?>

            <?php if ($post->getImage()): ?>
                <img src="<?= $post->getImageURL('small') ?>" alt="<?= $post->getImageURL('small') ?>"
                     width="250">
            <?php endif ?>
            <?= $form->file('image', 'Image à la une', 'thumbnail-form', 'mta') ?>
        </div>

        <?= $form->select('images_ids', 'Images', $images) ?>
        <?= $form->select('files_ids', 'Documents', $files) ?>
        <?= $form->input('created_at', 'Date de publication', 'datepicker') ?>
        <button type="submit" class="btn-primary">
            <?php if ($post->getID() !== null): ?>
                Modifier
            <?php else: ?>
                Créer
            <?php endif ?>
        </button>
    </form>
</section>
