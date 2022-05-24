<section class="mt4">
    <p class="alert mb3">* champs requis</p>
    <form action="" method="POST" enctype="multipart/form-data" class="grid-form mt3">
        <?= $form->input('name', 'Titre', 'withSpace', 'required') ?>
        <?= $form->input('slug', 'URL', 'withDash', 'required') ?>
        <?= $form->textarea('content', 'Résumé') ?>
        <div class="thumbnail-form">
            <?= $form->file('image', 'Image à la une') ?>
            <?php if ($item->getImage()): ?>
                <img src="<?= $item->getImageURL('small') ?>" alt="<?= $item->getImageURL('small') ?>" width="250" height="112.5">
            <?php endif ?>
        </div>
        <?= $form->input('created_at', 'Date de publication', 'datepicker', null) ?>
        <button type="submit" class="btn-primary">
            <?php if ($item->getID() !== null): ?>
                Modifier
            <?php else: ?>
                Créer
            <?php endif ?>
        </button>
    </form>
</section>
