<section class="mt4">
    <form action="" method="POST" enctype="multipart/form-data">
        <?= $form->input('name', 'Titre', 'withSpace') ?>
        <?= $form->input('slug', 'URL', 'withDash') ?>
        <?php if($post->getImage()): ?>
            <img src="<?= $post->getImageURL('small') ?>" alt="<?= $post->getImageURL('small') ?>" width="250">
        <?php endif ?>
        <?= $form->file('image', 'Image à la une') ?>
        <?= $form->select('categories_ids', 'Catégories', $categories) ?>
        <a class="underline" href="<?= $router->url('admin_guide') ?>">Guide d'écriture simplifié (pour le contenu uniquement)</a>
        <?= $form->textarea('content', 'Contenu') ?>
        <?= $form->input('created_at', 'Date de publication') ?>
        <button class="btn-primary">
            <?php if ($post->getID() !== null): ?>
                Modifier
            <?php else: ?>
                Créer
            <?php endif ?>
        </button>
    </form>
</section>
