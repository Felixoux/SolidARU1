<?php

use App\{Attachment\PostAttachment,
    Auth,
    Connection,
    HTML\Form,
    Model\Post,
    Table\CategoryTable,
    Table\PostTable,
    Validators\PostValidator};

Auth::check();
$success = false;
$errors = [];

$pdo = Connection::getPDO();
$post = new Post();
$categoryTable = new CategoryTable($pdo);
$categories = $categoryTable->list();
$post->setCreatedAt(date('Y-m-d H:i:s'));
if (!empty($_POST)) {
    $postTable = new PostTable($pdo);
    $data = array_merge($_POST, $_FILES);
    $v = new PostValidator($data, $postTable, $post->getID(), $categories);
    (new App\ObjectHelper)->hydrate($post, $data, ['name', 'content', 'slug', 'created_at', 'image']);

    if ($v->validate()) {
        $pdo->beginTransaction();
        (new PostAttachment)->upload($post);
        $postTable->createPost($post);
        $postTable->attachCategories($post->getID(), $_POST['categories_ids']);
        $pdo->commit();
        header('Location: ' . $router->url('admin_posts') . '?created=1');
    } else {
        $errors = $v->errors();
    }
}
$form = new Form($post, $errors);
?>
<h2 class="container mt4 medium-title">Créer un article</h2>
<hr>

<?php require('_form.php'); ?>
