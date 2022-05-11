<?php

use App\{Auth, Connection, Table\FileTable};

Auth::check();

$pdo = Connection::getPDO();
$table = new FileTable($pdo);
$file = $table->find($params['id']);
$table->delete($params['id']); // Supprimer le doc de la bdd
$link = UPLOAD_PATH . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . $file->getName();
if (file_exists($link)) {
    unlink($link); // Supprimer le doc des fichiers
}
header('Location: ' . $router->url('admin_files') . '?delete=1');
