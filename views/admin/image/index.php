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
        'format/alert-danger' => "Mauvais format d'image"
    ];
foreach ($alerts as $get => $message) {
    echo($alert->getAlert($get, $message));
}

$listingQuery = new listingQuery($items, $pagination, $link, 'image', 'image', $router);
echo($listingQuery->getHeaderListing()); // Display header
foreach ($items as $item) {
    echo($listingQuery->getbodyListing($item)); // Display Items
}
echo($listingQuery->getFooterListing()); // Display pagination buttons
?>
