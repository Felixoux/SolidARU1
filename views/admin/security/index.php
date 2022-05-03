<?php
use App\{Connection, Auth, HTML\Form, Model\User, Table\Exception\NotFoundException, Table\UserTable};

Auth::check();

$pdo = Connection::getPDO();
$table = new UserTable($pdo);
$user = $table->all()[0];
$errors = [];
$success = null;
if(!empty($_POST)) {
    if(isset($_POST['current_password']) && isset($_POST['new_password']) && isset($_POST['new_password2'])) {
        $psw = $_POST['current_password'];
        $new_psw = $_POST['new_password'];
        $new_psw_1 = $_POST['new_password2'];
        if(!password_verify($psw, $user->getPassword())) {
            $errors = ['Le mot de passe actuel ne correspond pas'];
        } elseif($new_psw !== $new_psw_1) {
            $errors = ['Veuillez écrire 2 fois le même mot de passe'];
        } elseif ($psw === $new_psw) {
            $errors = ['Le nouveau mot de passe doit être différent de l\'actuel'];
        } else {
            $table->updateUser($user, $new_psw);
            $success = 'Le mot de passe à bien été modifié';
        }
    }
}
$form = new Form($user, $errors);
?>
<?php if ($errors): ?>
    <p class="alert alert-danger"><?= $errors[0] ?></p>
<?php endif ?>
<?php if ($success): ?>
    <p class="alert alert-success"><?= $success ?></p>
<?php endif ?>

<h2 class="mt4 medium-title">Changer le mot de passe</h2>
<hr>
<?php require '_form.php' ?>
