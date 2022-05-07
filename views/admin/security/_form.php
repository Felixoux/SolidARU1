    <form  action="" method="POST">
        <?= $form->inputSecurity('new_password', 'Nouveau mot de passe') ?>
        <?= $form->inputSecurity('new_password_confirm', 'Confirmer le mot de passe') ?>
        <div class="form__button">
            <button type="submit" class="btn-primary">Modifier</button>
            <button type="reset" class="btn-primary-outline">Annuler</button>
        </div>
    </form>

