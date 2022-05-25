<?php

use App\{Auth, Connection, Table\ImageTable};

Auth::check();

$pdo = Connection::getPDO();
$table = new ImageTable($pdo);
$image = $table->find($params['id']);
Auth::checkToken($_SESSION['token'], $params['token'], $router);

$table->delete($params['id']); // Supprimer la photo de la bdd
$link = UPLOAD_PATH . DIRECTORY_SEPARATOR . 'posts_multiple' . DIRECTORY_SEPARATOR . $image->getName();
if (file_exists($link)) {
    unlink($link); // Supprimer la photo des fichiers
}
header('Location: ' . $router->url('admin_images') . '?delete=1');
