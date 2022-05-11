<?php
$css_flatpickr = '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.css">';
$beforeBodyContent = ob_before($css_flatpickr);
$js_flatpickr = <<<HTML
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.js"></script> 
    <script src="/js/datePicker.js"></script>
    HTML;
$afterBodyContent = ob_after($js_flatpickr);

use App\{Attachment\PostAttachment,
    Auth,
    Connection,
    HTML\Form,
    Model\Post,
    Table\CategoryTable,
    Table\ImageTable,
    Table\PostTable,
    Validators\PostValidator
};

Auth::check();
$pdo = Connection::getPDO();
$post = new Post();
$categories = (new CategoryTable($pdo))->list();
$images = (new ImageTable($pdo))->list();
$post->setCreatedAt(date('Y-m-d H:i:s'));

$success = false;
$errors = [];
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
        if (isset($_POST['images_ids'])) {
            $postTable->attachImages($post->getID(), $_POST['images_ids']);
        }
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
