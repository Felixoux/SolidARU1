    <form  action="" method="POST">
        <?= $form->inputSecurity('current_password', 'Mot de passe actuel') ?>
        <?= $form->inputSecurity('new_password', 'Nouveau mot de passe') ?>
        <?= $form->inputSecurity('new_password2', 'Verification nouveau mot de passe') ?>
        <div class="flex">
            <button type="submit" class="btn-primary">Modifier</button>
            <button type="reset" class="btn-primary-outline">Annuler</button>
        </div>
    </form>

