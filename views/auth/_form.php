<form action="<?= $router->url('login') ?>" method="POST">
    <?= $form->input('username', 'Nom d\'utilisateur') ?>
    <?= $form->input('password', 'Mot de passe') ?>
    <div class="flex">
        <button type="submit" class="btn-primary">Se connecter</button>
        <button type="reset" class="btn-primary-outline">Annuler</button>
    </div>
</form>