<section class="mt4">
    <form action="" method="POST" enctype="multipart/form-data">
        <p class="alert">* champs requis</p>
        <?= $form->input('name', 'Titre', 'withSpace', 'required') ?>
        <?= $form->input('slug', 'URL', 'withDash', 'required') ?>
        <?php if ($item->getImage()): ?>
            <img src="<?= $item->getImageURL('small') ?>" alt="<?= $item->getImageURL('small') ?>"
                 width="250">
        <?php endif ?>
        <?= $form->file('image', 'Image à la une') ?>
        <?= $form->textarea('content', 'Résumé') ?>
        <?= $form->input('created_at', 'Date de publication', 'datepicker') ?>
        <button type="submit" class="btn-primary">
            <?php if ($item->getID() !== null): ?>
                Modifier
            <?php else: ?>
                Créer
            <?php endif ?>
        </button>
    </form>
</section>
