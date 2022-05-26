<?php
use App\{Attachment\CategoryAttachment,
    Auth,
    Connection,
    HTML\Form,
    Model\Category,
    ObjectHelper,
    Table\CategoryTable,
    Validators\CategoryValidator
};

Auth::check();
$item = new Category();
$success = false;
$errors = [];
$item->setCreatedAt(date('Y-m-d H:i:s'));
$fields = ['name', 'slug', 'content', 'image'];
$data = array_merge($_POST, $_FILES);
if (!empty($_POST)) {
    $pdo = Connection::getPDO();
    $table = new CategoryTable($pdo);
    $v = new CategoryValidator($data, $table);
    ObjectHelper::hydrate($item, $data, $fields);

    if ($v->validate()) {
        $categoryAttachment = new CategoryAttachment;
        $categoryAttachment->upload($item); // On mets la thumbnail
        $table->createPC($item);
        header('Location: ' . $router->url('admin_categories') . '?created=1');
        exit();
    } else {
        $errors = $v->errors();
    }
}
$form = new Form($item, $errors);
?>
<h2 class="container mt4 medium-title">Créer une catégorie</h2>
<hr>

<?php require('_form.php'); ?>

<?php
// Flatpickr
$css_flatpickr = '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.css">';
$beforeBodyContent = ob_before($css_flatpickr);
$js_flatpickr = <<<HTML
<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.js"></script>
<script src="/js/datePicker.js"></script>
HTML;
$afterBodyContent = ob_after($js_flatpickr);