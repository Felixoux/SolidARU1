<section class="mt4">
    <form action="" method="POST" enctype="multipart/form-data">
        <p class="alert">* champs requis</p>
        <?= $form->input('name', 'Titre', 'withSpace', 'required') ?>
        <?= $form->input('slug', 'URL', 'withDash', 'required') ?>
        <?= $form->select('categories_ids', 'Catégories', $categories, 'required') ?>
        <a class="underline" href="<?= $router->url('admin_guide') ?>">Guide d'écriture simplifié (pour le contenu
            uniquement)</a>
        <?= $form->textarea('content', 'Contenu') ?>
        <?php if ($post->getImage()): ?>
            <img src="<?= $post->getImageURL('small') ?>" alt="<?= $post->getImageURL('small') ?>" width="250">
        <?php endif ?>
        <?= $form->file('image', 'Image à la une') ?>
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
