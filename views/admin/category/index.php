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
        'delete' => "La catégorie a bien été supprimée",
        'created' => "La catégorie a bien été créé"
    ];
foreach ($alerts as $get => $message) {
    echo($alert->getAlert($get, $message));
}
// Get listing page
$data = ["category" => 'catégorie/category-title'];
$listingQuery = new listingQuery($items, $pagination, $data, $link, $router);
$listingQuery->getListing();

