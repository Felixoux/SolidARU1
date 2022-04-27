<?php
use App\HTML\Form;
use App\Connection;
use App\Table\PostTable;
use Valitron\Validator;

$pdo = Connection::getPDO();
$postTable = new PostTable($pdo);
$post = $postTable->find($params['id']);
$success = false;

$errors = [];
if(!empty($_POST)) {
    Validator::lang('fr');
    $v = new Validator($_POST);
    $v->setPrependLabels(false);
    $v->rule('required', ['name', 'slug']);
    $v->rule('lengthBetween', ['name', 'slug'], 3, 200);
    $post
        ->setName($_POST['name'])
        ->setContent($_POST['content'])
        ->setSlug($_POST['slug'])
        ->setCreatedAt($_POST['created_at']);

    if($v->validate()) {
        try {
            $postTable->update($post);
        } catch (Exception $e) {
        }
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

<section class="big-section">
    <form action="" method="POST">
            <?= $form->input('name', 'Titre') ?>
            <?= $form->input('slug', 'URL') ?>
            <?= $form->textarea('content', 'Contenu') ?>
            <?= $form->input('created_at', 'Date de publication') ?>
        <button class="btn btn-primary">Modifier</button>
    </form>
</section>
