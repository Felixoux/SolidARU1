<section class="mt4">
    <form action="" method="POST" enctype="multipart/form-data">
        <?= $form->input('name', 'Titre') ?>
        <?= $form->input('slug', 'URL') ?>
<!--         --><?//= $form->file('image', 'Image à la une') ?>
        <?= $form->select('categories_ids', 'Catégories', $categories) ?>
        <?= $form->textarea('content', 'Contenu') ?>
        <?= $form->input('created_at', 'Date de publication') ?>
        <button class="btn btn-primary">
            <?php if ($post->getID() !== null): ?>
                Modifier
            <?php else: ?>
                Créer
            <?php endif ?>
        </button>
    </form>
</section>
