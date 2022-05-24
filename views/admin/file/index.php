<?php

use App\{Auth, Connection, listingQuery, Table\FileTable};

Auth::check();
$pageTitle = 'Gestion des images';
$pdo = Connection::getPDO();
[$items, $pagination] = (new FileTable($pdo))->findPaginated();
$link = $router->url('admin_files');
?>
<?php if (isset($_GET['delete'])): ?>
    <p class="alert alert-success">Document supprimée avec succès</p>
<?php endif ?>
<?php if (isset($_GET['created'])): ?>
    <p class="alert alert-success">Document(s) ajoutée(s) avec succès</p>
<?php endif ?>
<?php if (isset($_GET['duplicated'])): ?>
    <p class="alert alert-danger">Document(s) déjà existant(s)</p>
<?php endif ?>
<?php if (isset($_GET['format'])): ?>
    <p class="alert alert-danger">Mauvais format de document</p>
<?php endif ?>
<?php
$listingQuery = new listingQuery($items, $pagination, $link, 'file', 'document', $router);
echo($listingQuery->getHeaderListing()); // Display header
foreach ($items as $item) {
    echo($listingQuery->getbodyListing($item)); // Display Items
}
echo($listingQuery->getFooterListing()); // Display pagination buttons
?>


