<?php

use App\{Auth, Connection, listingQuery, Table\CategoryTable};

require ROOT_PATH . '/vendor/autoload.php';
Auth::check();
$pageTitle = 'Gestion des catégories';
$pdo = Connection::getPDO();
$link = $router->url('admin_categories');
[$items, $pagination] = (new CategoryTable($pdo))->findPaginated();

?>
<?php if (isset($_GET['delete'])): ?>
    <p class="alert alert-success">La catégorie a bien été supprimée</p>
<?php endif ?>
<?php if (isset($_GET['created'])): ?>
    <p class="alert alert-success">La catégorie a bien été créée</p>
<?php endif ?>
<?php if (isset($_GET['modified'])): ?>
    <p class="alert alert-success">La catégorie a bien été modifiée</p>
<?php endif ?>
<?php
$listingQuery = new listingQuery($items, $pagination, $link, 'category', 'catégorie', $router);
echo($listingQuery->getHeaderListing()); // Display header
foreach ($items as $item) {
    echo($listingQuery->getbodyListing($item)); // Display Items
}
echo($listingQuery->getFooterListing()); // Display pagination buttons
?>

