<?php
use App\{Auth, Connection, HTML\Form, Model\User, Table\Exception\NotFoundException, Table\UserTable, Helper};
$pageTitle = "Connection";
$user = new User();
$errors = [];

if (!empty($_POST)) {
    $user->setUsername($_POST['username']);
    $errors['password'] = ['Identifiant ou mot de passe incorrect'];
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $table = new UserTable(Connection::getPDO());
        try {
            $u = $table->findByUsername($_POST['username']);
            $cookieValue = $u->getUsername() . '-----' . sha1($u->getUsername() . $u->getPassword() . $_SERVER['REMOTE_ADDR']);
            $duration = time() + 3600 * 24 * 3;
            if (password_verify($_POST['password'], $u->getPassword()) === true) {
                Helper::sessionStart();
                $_SESSION['auth'] = 'connected';
                if(isset($_POST['remember'])) {
                    (new Helper())->createCookie('auth', $cookieValue, C('domain'), $duration);
                }
                header('Location: ' . $router->url('admin_posts'));
                exit();
            };
        } catch (NotFoundException $e) {
        }
    }
}

$form = new Form($user, $errors);
?>
<div class="form-card">
    <h1 class="form-card__title">Se connecter</h1>
    <?php if (isset($_GET['forbidden'])): ?>
        <p class="alert-danger mb4">Vous ne pouvez pas accéder à cette page</p>
    <?php endif ?>
    <?php require '_form.php' ?>
</div>

<?php ob_start(); ?>
<meta content="noindex">
<?php $beforeBodyContent = ob_get_clean();
