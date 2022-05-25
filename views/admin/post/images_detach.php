<?php

use App\{Attachment\PostAttachment, Auth, Connection, Table\PostTable};

Auth::check();

$pdo = Connection::getPDO();
$table = new PostTable($pdo);
$post = $table->find($params['id']);
Auth::checkToken($_SESSION['token'], $params['token'], $router);

(new \App\Table\ImageTable($pdo))->detachItems($post->getID());
header('Location: ' . $router->url('admin_post', ['id' => $post->getID()]) . '?images_detach=1');
exit();




