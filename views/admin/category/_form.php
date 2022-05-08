<section class="mt4">
    <form action="" method="POST" enctype="multipart/form-data">
        <p class="alert">* champs requis</p>
        <?= $form->input('name', 'Titre', 'withSpace') ?>
        <?= $form->input('slug', 'URL', 'withDash') ?>
        <?php if($item->getImage()): ?>
            <img src="<?= $item->getImageURL('small') ?>" alt="<?= $item->getImageURL('small') ?>" width="250">
        <?php endif ?>
        <?= $form->file('image', 'Image à la une') ?>
        <?= $form->textarea('content', 'Résumé') ?>
        <button class="btn-primary">
            <?php if ($item->getID() !== null): ?>
                Modifier
            <?php else: ?>
                Créer
            <?php endif ?>
        </button>
    </form>
</section>
