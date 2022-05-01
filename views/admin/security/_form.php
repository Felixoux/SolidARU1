<section>
    <form action="" method="POST">
        <?= $form->inputSecurity('current_password', 'Mot de passe actuel') ?>
        <?= $form->inputSecurity('new_password', 'Nouveau mot de passe') ?>
        <?= $form->inputSecurity('new_password2', 'Nouveau mot de passe') ?>
        <button class="btn btn-primary">Modifier</button>
    </form>
</section>

