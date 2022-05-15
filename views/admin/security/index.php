<?php
use App\{Connection, Auth, HTML\Form, Model\User, Table\Exception\NotFoundException, Table\UserTable};

Auth::check();

$pdo = Connection::getPDO();
$table = new UserTable($pdo);
$user = $table->all()[0];
$errors = [];
$success = null;
if(!empty($_POST)) {
    if(isset($_POST['new_password']) && isset($_POST['new_password_confirm'])) {
        $psw = $_POST['new_password'];
        $psw_confirm = $_POST['new_password_confirm'];
        if($psw !== $psw_confirm) {
            $errors = ['Veuillez écrire 2 fois le même mot de passe'];
        } else {
            $table->updateUser($user, $psw);
            $success = 'Le mot de passe à bien été modifié';
        }
    }
}
$form = new Form($user, $errors);
?>

<div class="form-card">
    <?php if ($errors): ?>
        <p class="alert alert-danger"><?= $errors[0] ?></p>
    <?php endif ?>
    <?php if ($success): ?>
        <p class="alert alert-success"><?= $success ?></p>
    <?php endif ?>
    <h2 class="form-card__title">
        <svg class="lock_svg">
            <use xlink:href="/img/svg/sprite.svg#lock"></use>
        </svg>
        Mot de passe
    </h2>
    <?php require '_form.php' ?>
</div>

