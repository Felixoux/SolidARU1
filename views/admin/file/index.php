<?php

use App\{Auth, Connection, HTML\Alert, HTML\ListingQuery, Table\FileTable};

Auth::check();
$pageTitle = 'Gestion des documents';
$pdo = Connection::getPDO();
[$items, $pagination] = (new FileTable($pdo))->findPaginated();
$link = $router->url('admin_files');

// Get alerts
$alert = new Alert();
$alerts =
    [
        'delete' => "Document supprimé avec succès",
        'created' => "Document(s) ajouté(s) avec succès",
        'duplicated/alert-danger' => "Document(s) déjà existant(s)",
        'format/alert-danger' => "Seulement le format (pdf) est accapté"
    ];
foreach ($alerts as $get => $message) {
    echo($alert->getAlert($get, $message));
}
// Get page listing
$data = ["file" => 'document/document'];
$listingQuery = new listingQuery($items, $pagination, $data, $link, $router);
$listingQuery->getListing();