<?php
use App\{Table\PostTable, Connection, Auth};

Auth::check();

$pdo = Connection::getPDO();
$table = new PostTable($pdo);
// TODO get rid of the comment to reestablish the delete button
// $table->delete($params['id']);
header('Location: ' . $router->url('admin_posts') . '?delete=1');
?>


<h1><?= 'suppression de l\'article ' . $params['id'] ?></h1>
