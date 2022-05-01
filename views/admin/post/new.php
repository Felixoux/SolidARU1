<?php
use App\{HTML\Form, Connection, Table\PostTable, Validators\PostValidator, Model\Post};

$success = false;
$errors = [];
$post = new Post();
$post->setCreatedAt(date('Y-m-d H:i:s'));
if(!empty($_POST)) {
    $pdo = Connection::getPDO();
    $postTable = new PostTable($pdo);
    $v = new PostValidator($_POST, $postTable, $post->getID());
    (new App\ObjectHelper)->hydrate($post, $_POST, ['name', 'content', 'slug', 'created_at']);

    if($v->validate()) {
        $postTable->create($post);
        header('Location: ' . $router->url('admin_posts') . '?created=1');
    } else {
        $errors = $v->errors();
    }
}
$form = new Form($post, $errors);
?>
<h1 class="container mt4 mb4">Créer un article</h1>

<?php require('_form.php'); ?>
