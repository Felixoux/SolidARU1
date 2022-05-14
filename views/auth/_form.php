<form class="login-form" action="<?= $router->url('login') ?>" method="POST">
    <?= $form->input('username', 'Nom d\'utilisateur') ?>
    <?= $form->input('password', 'Mot de passe') ?>
    <?= $form->checkbox('remember', 'Rester connecter', 'remember-checkbox') ?>
    <div class="form__button">
        <button type="submit" class="btn-primary">Se connecter</button>
        <button type="reset" class="btn-primary-outline">Annuler</button>
    </div>
</form>