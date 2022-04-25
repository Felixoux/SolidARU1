<?php

use App\Connection;
use App\Table\PostTable;
use Valitron\Validator;

$pdo = Connection::getPDO();
$postTable = new PostTable($pdo);
$post = $postTable->find($params['id']);
$success = false;

$errors = [];
if(!empty($_POST)) {
    Validator::lang('fr');
    $v = new Validator($_POST);
    $v->setPrependLabels(false);
    $v->rule('required', 'name');
    $v->rule('lengthBetween', 'name', 3, 200);
    $post->setName($_POST['name']);
    if($v->validate()) {
        $postTable->update($post);
        $success = true;
    } else {
        $errors = $v->errors();
    }

}
?>
<?php if($success): ?>
<div class="container">
    <p class="alert alert-success">L'article a bien été modifié</p>
</div>
<?php endif ?>
<h1 class="container mt4 mb4">Editer l'article "<?= e($post->getName()) ?>"</h1>

<section class="big-section">
    <form action="" method="POST">
        <div class="form-group">
            <label for="name">Titre</label>
            <input type="text" name="name" value="<?= e($post->getName()) ?>">
            <?php if(isset($errors['name'])): ?>
                <div class="container">
                    <p class="alert alert-danger"><?= e($errors['name'][0]) ?></p>
                </div>
            <?php endif ?>
        </div>
        <button class="btn btn-primary">Modifier</button>

    </form>
</section>
