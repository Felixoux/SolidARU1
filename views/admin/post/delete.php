<?php

use App\{Attachment\PostAttachment, Auth, Connection, Table\PostTable};

Auth::check();

$pdo = Connection::getPDO();
$table = new PostTable($pdo);
$post = $table->find($params['id']);
if ($_SESSION['token'] !== $params['token']) {
    header('Location :' . $router->url('admin_posts'));
    exit();
}
(new PostAttachment())->detach($post);
$table->delete($params['id']);
header('Location: ' . $router->url('admin_posts') . '?delete=1');
?>


