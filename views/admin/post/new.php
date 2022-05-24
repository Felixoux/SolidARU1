<?php
use App\{Attachment\PostAttachment,
    Auth,
    Connection,
    HTML\Form,
    Model\Post,
    Table\CategoryTable,
    Table\FileTable,
    Table\ImageTable,
    Table\PostTable,
    Validators\PostValidator};

Auth::check();
$pdo = Connection::getPDO();
$post = new Post();
$categories = (new CategoryTable($pdo))->list();
$images = (new ImageTable($pdo))->list();
$files = (new FileTable($pdo))->list();
$created_at = $post->setCreatedAt(date('Y-m-d H:i:s'));

$errors = [];
if (!empty($_POST)) {
    $postTable = new PostTable($pdo);
    $data = array_merge($_POST, $_FILES);
    $v = new PostValidator($data, $postTable, $post->getID(), $categories, $images, $files);
    (new App\ObjectHelper)->hydrate($post, $data, ['name', 'content', 'slug', 'created_at', 'image']);
    if ($v->validate()) {
        $pdo->beginTransaction();
        (new PostAttachment)->upload($post);
        $postTable->createPC($post);
        $postTable->attachAll($pdo, $post); // Attach categories | Images | Files
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

<?php ob_start() //Flatpickr ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.css">
<?php $beforeBodyContent = ob_get_clean();
ob_start()?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.js"></script>
<script src="/js/datePicker.js"></script>
<?php $afterBodyContent = ob_get_clean();