<section class="mt4">
    <form action="" method="POST" enctype="multipart/form-data">
        <?= $form->input('name', 'Titre') ?>
        <?= $form->input('slug', 'URL') ?>
<!--         --><?//= $form->file('image', 'Image à la une') ?>
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
