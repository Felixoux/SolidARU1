<?php
use App\{HTML\Form, Connection, Table\PostTable, Validators\PostValidator, ObjectHelper};

$pdo = Connection::getPDO();
$postTable = new PostTable($pdo);
$post = $postTable->find($params['id']);
$success = false;

$errors = [];
if(!empty($_POST)) {
    $v = new PostValidator($_POST, $postTable, $post->getID());
    ObjectHelper::hydrate($post, $_POST, ['name', 'content', 'slug', 'created_at']);

    if($v->validate()) {
        $postTable->update($post);
        $success = true;
    } else {
        $errors = $v->errors();
    }

}

$form = new Form($post, $errors);
?>
<?php if($success): ?>
<p class="alert alert-success">L'article a bien été modifié</p>
<?php endif ?>
<h1 class="container mt4 mb4">Editer l'article "<?= e($post->getName()) ?>"</h1>

<?php require '_form.php' ?>
