<?php

use App\{Attachment\CategoryAttachment,
    Auth,
    Connection,
    HTML\Form,
    Model\Category,
    ObjectHelper,
    Table\CategoryTable,
    Validators\CategoryValidator};

Auth::check();
$item = new Category();
$success = false;
$errors = [];

$fields = ['name', 'slug', 'content', 'image'];
$data = array_merge($_POST, $_FILES);
if (!empty($_POST)) {
    $pdo = Connection::getPDO();
    $table = new CategoryTable($pdo);
    $v = new CategoryValidator($data, $table);
    (new ObjectHelper)->hydrate($item, $data, $fields);

    if($v->validate()) {
        $categoryAttachment = new CategoryAttachment;
        $categoryAttachment->upload($item);
        $table->create([
            'name' => $item->getName(),
            'slug' => $item->getSlug(),
            'content' => $item->getContent(),
            'image' => $item->getImage()
        ]);
        header('Location: ' . $router->url('admin_categories') . '?created=1');
    } else {
        $errors = $v->errors();
    }
}
$form = new Form($item, $errors);
?>
<h2 class="container mt4 medium-title">Créer une catégorie</h2>
<hr>

<?php require('_form.php'); ?>
