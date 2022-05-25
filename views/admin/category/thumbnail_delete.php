<?php

use App\{Attachment\CategoryAttachment, Auth, Connection, Table\CategoryTable};

Auth::check();

$table = new CategoryTable((new Connection())::getPDO());
$item = $table->find($params['id']);
Auth::checkToken($_SESSION['token'], $params['token'], $router);

(new CategoryAttachment())->detach($item);
header('Location: ' . $router->url('admin_category', ['id' => $item->getID()]) . '?delete_thumbnail=1');
?>


