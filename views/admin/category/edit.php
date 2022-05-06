<?php

use App\{Auth, Connection, HTML\Form, ObjectHelper, Table\CategoryTable, Validators\CategoryValidator};

Auth::check();
$pdo = Connection::getPDO();
$table = new CategoryTable($pdo);
$item = $table->find($params['id']);
$success = false;
$errors = [];
$fields = ['name', 'slug', 'content'];
if (!empty($_POST)) {
    $v = new CategoryValidator($_POST, $table, $item->getID());
    ObjectHelper::hydrate($item, $_POST, $fields);

    if ($v->validate()) {
        $table->update([
            'name' => $item->getName(),
            'slug' => $item->getSlug(),
            'content' => $item->getContent()
        ], $item->getID());
        $success = true;
    } else {
        $errors = $v->errors();
    }

}

$form = new Form($item, $errors);
?>
<?php if ($success): ?>
    <p class="alert alert-success">La catégorie a bien été modifié</p>
<?php endif ?>
<h2 class="mt4 medium-title">Editer la catégorie "<?= e($item->getName()) ?>"</h2>
<hr>
<?php require '_form.php' ?>
