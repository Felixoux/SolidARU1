<?php

use App\{Auth, Connection, listingQuery, Table\PostTable};

Auth::check();
$pageTitle = 'Gestion des articles';
$pdo = Connection::getPDO();
$link = $router->url('admin_posts');
[$items, $pagination] = (new PostTable($pdo))->findPaginated();
?>
<?php if (isset($_GET['delete'])): ?>
    <p class="alert alert-success">L'article a bien été supprimé</p>
<?php endif ?>
<?php if (isset($_GET['created'])): ?>
    <p class="alert alert-success">L'article a bien été créé</p>
<?php endif ?>
<?php if (isset($_GET['modified'])): ?>
    <p class="alert alert-success">L'article a bien été modifié</p>
<?php endif ?>
<?php
$listingQuery = new listingQuery($items, $pagination, $link, 'post', 'article', $router);
echo($listingQuery->getHeaderListing()); // Display header
foreach ($items as $item) {
    echo($listingQuery->getbodyListing($item)); // Display Items
}
echo($listingQuery->getFooterListing()); // Display pagination footer (buttons)
?>

