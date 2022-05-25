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
                <?php if ($post->getImage()): ?>
                    <img  src="<?= $post->getImageURL('small') ?>" alt="<?= $post->getImageURL('small') ?>" width="200" height="112.5">
                <?php endif ?>
            </div>
        </div>
        <?= $form->select('images_ids', 'Images', $images) ?>
        <?= $form->select('files_ids', 'Documents', $files) ?>
        <?= $form->input('created_at', 'Date de publication', 'datepicker') ?>
        <h4 class="alert">Zone danger</h4>
        <!--<form method="POST"
              action="<?/*= $router->url('admin_image_detach', ['id' => $post->getID(), 'token' => $_SESSION['token']]) */?>"
              onsubmit="return confirm('Voulez vous vraiment détacher les images de cet article ?')">
            <button type="submit" class="btn btn-alert">Détacher les images de l'article</button>
        </form>
        <button class="btn-alert"><a href="#">Détacher les documents du post</a></button>-->
        <button type="submit" class="btn-primary">
            <?php if ($post->getID() !== null): ?>
                Modifier
            <?php else: ?>
                Créer
            <?php endif ?>
        </button>
    </form>
</section>
