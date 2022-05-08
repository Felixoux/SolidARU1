    <form method="POST" onsubmit="return confirm('Êtes vous sur de changer le mot de passe ?')">
        <header>
            <h3 class="alert mb2">Danger zone</h3>
            <p class="muted">Assurez vous que le mot de passe comporte plusieurs caractères différents et ne soit pas trop court pour améliorer la sécurité.</p>
        </header>
        <?= $form->inputSecurity('new_password', 'Nouveau mot de passe') ?>
        <?= $form->inputSecurity('new_password_confirm', 'Confirmer le mot de passe') ?>
        <div class="form__button">
            <button type="submit" class="btn-primary">Modifier</button>
            <button type="reset" class="btn-primary-outline">Annuler</button>
        </div>
    </form>

