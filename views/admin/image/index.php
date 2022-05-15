<?php

use App\{Auth, Connection, listingQuery, Table\ImageTable};

require ROOT_PATH . '/vendor/autoload.php';
Auth::check();
$pageTitle = 'Gestion des images';
$pdo = Connection::getPDO();

[$items, $pagination] = (new ImageTable($pdo))->findPaginated();
$link = $router->url('admin_images');
?>
<?php if (isset($_GET['delete'])): ?>
    <p class="alert alert-success">Image supprimée avec succès</p>
<?php endif ?>
<?php if (isset($_GET['created'])): ?>
    <p class="alert alert-success">Image(s) ajoutée(s) avec succès</p>
<?php endif ?>
<?php if (isset($_GET['duplicated'])): ?>
    <p class="alert alert-danger">Image(s) déjà existante(s)</p>
<?php endif ?>
<?php if (isset($_GET['format'])): ?>
    <p class="alert alert-danger">Mauvais format d'image</p>
<?php endif ?>
<?php
$listingQuery = new listingQuery($items, $pagination, $link, 'image', 'image', $router);
echo($listingQuery->getHeaderListing()); // Display header
foreach ($items as $item) {
    echo($listingQuery->getbodyListing($item)); // Display Items
}
echo($listingQuery->getFooterListing()); // Display pagination buttons
?>
