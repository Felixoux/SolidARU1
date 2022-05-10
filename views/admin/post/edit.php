<?php
$css_flatpickr = '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.css">';
$beforeBodyContent = ob_before($css_flatpickr);
$js_flatpickr = '<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.js"></script>';
$afterBodyContent = ob_after($js_flatpickr);

use App\{Attachment\PostAttachment,
    Auth,
    Connection,
    HTML\Form,
    ObjectHelper,
    Table\CategoryTable,
    Table\ImageTable,
    Table\PostTable,
    Validators\PostValidator};

Auth::check();
$pdo = Connection::getPDO();
$postTable = new PostTable($pdo);
$post = $postTable->find($params['id']);
$categoryTable = new CategoryTable($pdo);
$categories = $categoryTable->list();
$imageTable = new ImageTable($pdo);
$images = $imageTable->list();
$imageTable->hydratePosts([$post]);
$categoryTable->hydratePosts([$post]);

$success = false;

$errors = [];
if (!empty($_POST)) {
    $data = array_merge($_POST, $_FILES);
    $v = new PostValidator($data, $postTable, $post->getID(), $categories);
    ObjectHelper::hydrate($post, $data, ['name', 'content', 'slug', 'created_at', 'image']);

    if ($v->validate()) {
        $pdo->beginTransaction();
        (new PostAttachment())->upload($post);
        $postTable->updatePost($post);
        $postTable->attachCategories($post->getID(), $_POST['categories_ids']);
        $postTable->attachImages($post->getID(), $_POST['images_ids']);
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
<h2 class="mt4 medium-title">Editer l'article "<?= e($post->getName()) ?>"</h2>
<hr>
<?php require '_form.php' ?>

