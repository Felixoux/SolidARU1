<?php

use App\{Auth, Connection, HTML\Alert, HTML\ListingQuery, Table\PostTable};

Auth::check();
$pageTitle = 'Gestion des articles';
$pdo = Connection::getPDO();
$link = $router->url('admin_posts');
[$items, $pagination] = (new PostTable($pdo))->findPaginated();

// Get alerts
$alert = new Alert();
$alerts =
    [
        'delete' => "L'article a bien été supprimé",
        'created' => "L'article a bien été créé",
        'modified' => "L'article a bien été modifié"
    ];
foreach ($alerts as $get => $message) {
    echo($alert->getAlert($get, $message));
}

$listingQuery = new listingQuery($items, $pagination, $link, 'post', 'article', $router);
echo($listingQuery->getHeaderListing()); // Display header
foreach ($items as $item) {
    echo($listingQuery->getbodyListing($item)); // Display Items
}
echo($listingQuery->getFooterListing()); // Display pagination footer (buttons)
?>

