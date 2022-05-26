<?php

use App\{Auth, Connection, HTML\Alert, HTML\ListingQuery, Table\FileTable};

Auth::check();
$pageTitle = 'Gestion des images';
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
        'format/alert-danger' => "Mauvais format d'image"
    ];
foreach ($alerts as $get => $message) {
    echo($alert->getAlert($get, $message));
}

$listingQuery = new listingQuery($items, $pagination, $link, 'file', 'document', $router);
echo($listingQuery->getHeaderListing()); // Display header
foreach ($items as $item) {
    echo($listingQuery->getbodyListing($item)); // Display Items
}
echo($listingQuery->getFooterListing()); // Display pagination buttons