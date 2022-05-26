<?php

use App\{Auth, Connection, HTML\Alert, HTML\ListingQuery, Table\CategoryTable};

Auth::check();
$pageTitle = 'Gestion des catégories';
$pdo = Connection::getPDO();
$link = $router->url('admin_categories');
[$items, $pagination] = (new CategoryTable($pdo))->findPaginated();

// Get alerts
$alert = new Alert();
$alerts =
    [
        'delete' => "La catégorie a bien été supprimé",
        'created' => "La catégorie a bien été créé",
        'modified' => "La catégorie a bien été modifié"
    ];
foreach ($alerts as $get => $message) {
    echo($alert->getAlert($get, $message));
}

$listingQuery = new listingQuery($items, $pagination, $link, 'category', 'catégorie', $router);
echo($listingQuery->getHeaderListing()); // Display header
foreach ($items as $item) {
    echo($listingQuery->getbodyListing($item)); // Display Items
}
echo($listingQuery->getFooterListing()); // Display pagination buttons
?>

