<?php

use App\{Auth, Connection, HTML\Form, ObjectHelper, Table\CategoryTable, Table\PostTable, Validators\PostValidator};

Auth::check();
$pdo = Connection::getPDO();
$postTable = new PostTable($pdo);
$categoryTable = new CategoryTable($pdo);
$categories = $categoryTable->list();
$post = $postTable->find($params['id']);
$categoryTable->hydratePosts([$post]);
$success = false;

$errors = [];
if (!empty($_POST)) {

    $v = new PostValidator(array_merge($_POST, $_FILES), $postTable, $post->getID(), $categories);
    ObjectHelper::hydrate($post, $_POST, ['name', 'content', 'slug', 'created_at']);

    if ($v->validate()) {
        $pdo->beginTransaction();
        $postTable->updatePost($post);
        $postTable->attachCategories($post->getID(), $_POST['categories_ids']);
        $categoryTable->hydratePosts([$post]);
        $pdo->commit();
        $success = true;
    } else {
        $errors = $v->errors();
    }

}

$form = new Form($post, $errors);
?>
<?php if ($success): ?>
    <p class="alert alert-success">L'article a bien été modifié</p>
<?php endif ?>
<h2 class="mt4 mb4">Editer l'article "<?= e($post->getName()) ?>"</h2>

<?php require '_form.php' ?>

