<?php

use App\{Attachment\PostAttachment, Auth, Connection, Table\PostTable};

Auth::check();
Auth::checkToken($_SESSION['token'], $params['token'], $router);

$pdo = Connection::getPDO();
$table = new PostTable($pdo);
$post = $table->find($params['id']);

(new PostAttachment())->detach($post);
$table->delete($params['id']);
header('Location: ' . $router->url('admin_posts') . '?delete=1');