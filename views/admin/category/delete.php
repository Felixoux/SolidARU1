<?php

use App\{Auth, Connection, Table\CategoryTable};

Auth::check();

$pdo = Connection::getPDO();
$table = new CategoryTable($pdo);
$table->delete($params['id']);
header('Location: ' . $router->url('admin_categories') . '?delete=1');
?>


<h1><?= 'suppression de l\'article ' . $params['id'] ?></h1>
