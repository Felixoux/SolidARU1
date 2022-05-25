<?php

use App\{Attachment\CategoryAttachment, Auth, Connection, Table\CategoryTable};

Auth::check();

$pdo = Connection::getPDO();
$table = new CategoryTable($pdo);
$category = $table->find($params['id']);
Auth::checkToken($_SESSION['token'], $params['token'], $router);

(new CategoryAttachment)->detach($category);
$table->delete($params['id']);
header('Location: ' . $router->url('admin_categories') . '?delete=1');
exit();
?>