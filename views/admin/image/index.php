<?php

use App\{Auth, Connection, HTML\Alert, HTML\ListingQuery, Table\ImageTable};

require ROOT_PATH . '/vendor/autoload.php';
Auth::check();
$pageTitle = 'Gestion des images';
$pdo = Connection::getPDO();

[$items, $pagination] = (new ImageTable($pdo))->findPaginated();
$link = $router->url('admin_images');

// Get alerts
$alert = new Alert();
$alerts =
    [
        'delete' => "Image supprimée avec succès",
        'created' => "Image(s) ajoutée(s) avec succès",
        'duplicated/alert-danger' => "Image(s) déjà existante(s)",
        'format/alert-danger' => "Seulement les formats (jpg, png, gif) sont acceptés"
    ];
foreach ($alerts as $get => $message) {
    echo($alert->getAlert($get, $message));
}
$data = ["image" => 'image/image'];

$listingQuery = new listingQuery($items, $pagination, $data, $link, $router);
$listingQuery->getListing();
