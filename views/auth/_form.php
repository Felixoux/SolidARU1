<form action="<?= $router->url('login') ?>" method="POST">
    <?= $form->input('username', 'Nom d\'utilisateur') ?>
    <?= $form->input('password', 'Mot de passe') ?>
    <?= $form->checkbox('remember', 'Se souvenir de moi', 'remember-checkbox') ?>
    <div class="form__button">
        <button type="submit" class="btn-primary">Se connecter</button>
        <button type="reset" class="btn-primary-outline">Annuler</button>
    </div>
</form>