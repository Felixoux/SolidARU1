<section class="mt4">
    <p class="alert mb3">* champs requis</p>
    <form action="" method="POST" enctype="multipart/form-data" class="grid-form mt3">
        <?= $form->input('name', 'Titre', 'withSpace', 'required') ?>
        <?= $form->input('slug', 'URL', 'withDash', 'required') ?>
        <?= $form->textarea('content', 'Résumé') ?>
        <div class="thumbnail-form">
            <?= $form->file('image', 'Image à la une') ?>
            <?php $link = UPLOAD_PATH . DIRECTORY_SEPARATOR .'categories' . DIRECTORY_SEPARATOR . $item->getImage() . '_' . 'small' . '.jpg'; ?>
            <?php if ($item->getImage() && file_exists($link)): ?>
                <img src="<?= $item->getImageURL('small') ?>" alt="<?= $item->getImageURL('small') ?>" width="250" height="112.5">
            <?php endif ?>
        </div>
        <?= $form->input('created_at', 'Date de publication', 'datepicker', null) ?>
        <?php if ($item->getID() !== 0): ?>
            <div class="danger-zone">
                <h4 class="alert mb1">Zone danger</h4>
                <a onclick="return confirm('Voulez vous vraiment supprimer l\'image à la une ?')" class="btn-alert mr2 mb2" href="<?= $router->url('category_thumbnail_delete', ['id' => $item->getID(), 'token' => $_SESSION['token']]) ?>">Supprimer l'image à la une</a>
                <a onclick="return confirm('Voulez vous vraiment supprimer la catégorie ?')" class="btn-alert" href="<?= $router->url('admin_category_delete', ['id' => $item->getID(), 'token' => $_SESSION['token']]) ?>">Supprimer la catégorie</a>
            </div>
        <?php endif ?>
        <button type="submit" class="btn-primary">
            <?php if ($item->getID() !== 0): ?>
                Modifier
            <?php else: ?>
                Créer
            <?php endif ?>
        </button>
    </form>
</section>
