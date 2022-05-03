<section>
    <form action="" method="POST">
        <?= $form->inputSecurity('current_password', 'Mot de passe actuel') ?>
        <?= $form->inputSecurity('new_password', 'Nouveau mot de passe') ?>
        <?= $form->inputSecurity('new_password2', 'Verification nouveau mot de passe') ?>
        <button><a class="btn-primary">Modifier</a></button>
    </form>
</section>

