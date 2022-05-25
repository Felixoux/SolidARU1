<?php

use App\{Attachment\PostAttachment, Auth, Connection, Table\PostTable};

Auth::check();

$table = new PostTable((new Connection())::getPDO());
$item = $table->find($params['id']);
Auth::checkToken($_SESSION['token'], $params['token'], $router);

(new PostAttachment())->detach($item);
header('Location: ' . $router->url('admin_post', ['id' => $item->getID()]) . '?delete_thumbnail=1');
?>


