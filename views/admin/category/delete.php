<?php

use App\{Attachment\CategoryAttachment, Auth, Connection, Table\CategoryTable};

Auth::check();

$pdo = Connection::getPDO();
$table = new CategoryTable($pdo);
$category = $table->find($params['id']);
if ($_SESSION['token'] !== $params['token']) {
    header('Location :' . $router->url('admin_categories'));
    exit();
}
(new CategoryAttachment)->detach($category);
$table->delete($params['id']);
header('Location: ' . $router->url('admin_categories') . '?delete=1');
exit();
?>