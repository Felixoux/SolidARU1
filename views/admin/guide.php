<?php
use App\Auth;

Auth::check();
$pageTitle = "Guide";
$domain = C('domain');
?>

<section class="guide">
    <h1 class="big-title"><strong>Guide</strong> d'administration du site</h1>
    <h2>Sommaire</h2>
    <ul class="summary-titles">
        <li><h3 class="medium-title"><a href="#login">1. Connection/déconnection</a></h3></li>
        <li><h3 class="medium-title"><a href="#create-article">2. Créer un article</a></h3></li>
        <li><h3 class="medium-title"><a href="#create-category">3. Créer une catégorie</a></h3></li>
        <li><h3 class="medium-title"><a href="#add-files">4. Ajouter des fichiers</a></h3></li>
        <li><h3 class="medium-title"><a href="#edit-pc">5. Édition des articles/catégories</a></h3></li>
        <li><h3 class="medium-title"><a href="#delete-items">6. Suppression des éléments</a></h3></li>
        <li><h3 class="medium-title"><a href="#change-pwd">7. Gérer le mot de passe</a></h3></li>
        <li><h3 class="medium-title"><a href="#md-guide">8. Écriture stylisée</a></h3></li>
    </ul>

    <div id="login" class="guide-group">

    <h2>Connection/déconnection</h2>
    <hr>
    <h4>Pour se connecter il faut: </h4>
    <ul>
        <li>Taper “/admin” à la fin du l’url de l’accueil, soit “<?= $domain ?>”.
            Ce qui donne “<?= $domain ?>/admin”.</li>
        <li>Ensuite entrer le nom d’utilisateur, par défaut “admin”.</li>
        <li>Et entrez le mot de passe, par défaut “admin”.</li>
        <li>Vous pouvez éventuellement cliquer sur “RESTER CONNECTER”.
            Cela va retenir votre état de connection pendant plusieurs jours pour ne pas avoir à se connecter tout le temps.
        </li>
    </ul>
    <h4>Une fois connecté :</h4>
    <ul>
        <li>Vous avez maintenant accès au panel administration ainsi que sa navigation. </li>
        <li>Pour revenir sur le site normal (celui que l’utilisateur standard voit), cliquez sur la maison
            dans la navigation. </li>
        <li>Vous aurez aussi un nouvel onglet “admin” qui apparaitra dans la navigation
            du site standard une fois connecté.
            Il est là pour éviter de devoir rentrer “/admin” à chaque fois qu’on veut retourner dans
            le panel admin.</li>
        <li>Et bien sur vous pouvez vous déconnecter à tout moment en cliquant sur le logo de
            déconnection
            à droite de la navigation.
        </li>
    </ul>
    </div>
    <div id="create-article" class="guide-group">
        <h2>Créer un article</h2>
        <hr>
        <h4>Pour créer un article, il faut :</h4>
        <ul>
            <li>Aller dans l’onglet “article” de la navigation et cliquer sur le bouton “ajouter un article”</li>
            <li>Entrer d’abord le titre de l’article tout simplement.</li>
            <li>Ensuite vous pouvez rentrer une URL personnalisée. Par défaut elle se complète toute seule avec le nom de l’article.</li>
            <li>Ensuite vous pouvez écrire du contenu, si vous désirez styliser le contenu, <a href="#md-guide">voici comment faire.</a></li>
            <li>Vous devez maintenant associer l’article à une ou plusieurs catégories. <a href="#create-category">Cliquer ici pour créer une catégorie</a></li>
        </ul>
        <h4>Maintenant pour les champs optionnels :</h4>
        <ul>
            <li>Vous pouvez ajouter une image à la une, cette image apparaitra sur la carte de l’article.</li>
            <li>Vous pouvez associer de multiples images au contenu de l’article en les sélectionnant. </li>
            <li>L’association des documents fonctionne comme les images. </li>
            <li>Vous n’avez pas d’images à associer ? C’est normal, il faut mettre en ligne. <a href="#add-files">Voir ici comment mettre en lignes
                    les images et les documents.</a></li>
            <li>Vous pouvez choisir la date de publication de l’article en dernier. Par défaut la date sera celle du jour actuel.</li>
        </ul>
        <h4>Et maintenant, cliquez sur le bouton “ajouter” !</h4>
    </div>
    <div id="create-category" class="guide-group">
        <h2>Créer une catégorie</h2>
        <hr>
        <h4>Pour créer une catégorie, il faut :</h4>
        <ul>
            <li>Aller dans l’onglet “catégorie” de la navigation et cliquez sur le bouton “ajouter une catégorie”</li>
            <li>Entrer d’abord le titre de la catégorie tout simplement.</li>
            <li>Ensuite vous pouvez rentrer une URL personnalisée. Par défaut elle se complète toute seule avec le nom de la catégorie.</li>
            <li>Ensuite vous pouvez écrire du contenu, juste un bref résumé de la catégorie pour que l’utilisateur sache de quoi
                il en retourne.</li>
        </ul>
        <h4>Maintenant pour les champs optionnels</h4>
        <ul>
            <li>Vous pouvez ajouter une image à la une, cette image apparaitra sur la carte de la catégorie.</li>
            <li>Vous pouvez choisir la date de publication de la catégorie en dernier. Par défaut la date sera celle du jour actuel.</li>
        </ul>
        <h4>Et pour finir, cliquez sur le bouton "ajouter" !</h4>
    </div>
    <div id="add-files" class="guide-group">
        <h2>Ajouter des fichiers</h2>
        <hr>
        <p class="muted">
            Pour ajouter des images et des documents, le principe est exactement le même, alors je ne ferais l’exemple qu’avec les images. Mais bien sûr, c'est valable pour les documents.
        </p>
        <h4>Pour ajouter des images/documents, il faut :</h4>
        <ul>
            <li>Aller dans l’onglet “images/documents” de la navigation et cliquer sur le bouton “ajouter un(e) image/document”</li>
            <li>La il vous suffit de parcourir votre ordinateur et de sélectionner un/des image(s)/document(s).</li>
        </ul>
        <h4>Et maintenant, cliquez sur le bouton "ajouter" !</h4>
        <h4>Désormais vous allez pouvoir associer ces images et documents à vos articles</h4>
        <p class="muted">Vous pouvez prévisualiser les images et les documents en cliquant sur leurs noms.</p>
    </div>
    <div id="edit-pc" class="guide-group">
        <h2>Édition des articles/catégories</h2>
        <hr>
        <h4>Pour éditer des articles/catégories, il faut: </h4>
        <ul>
            <li>Aller dans l’onglet “articles/catégories” de la navigation et cliquer sur le bouton “éditer” OU cliquez sur le bouton "Éditer" directement sur la page de l'article</li>
            <li>Là il vous suffit de modifier les champs que vous souhaitez changer et de cliquer sur le bouton “modifier” !</li>
            <li>En plus de ça, vous pouvez supprimer l'image à la une de l'article et des catégories en cliquant sur le bouton <span class="alert">"supprimer l'image à la une"</span></li>
            <li>Vous pouvez aussi dissocier les images et les documents du contenu en cliquant sur leur bouton respectif dans la section <span class="alert">"Zone danger"</span>.</li>
        </ul>
    </div>
    <div id="delete-items" class="guide-group">
        <h2 class="alert">Suppression des éléments</h2>
        <hr>
        <p class="muted">
            La suppression de tous les éléments fonctionnent de la même manière. Je vais faire l’exemple avec les articles.
        </p>
        <h4>Pour supprimer un élément, il faut :</h4>
        <ul>
            <li>Aller dans son onglet par la navigation.</li>
            <li>Trouver l’élément en particulier.</li>
            <li>Et cliquer sur le bouton “supprimer” à côté du bouton “éditer”, il y a une confirmation au cas où c’est une erreur. Comme ça, pas de dérapage.</li>
        </ul>
        <h4 style="text-decoration: underline">Chose à savoir sur la suppression de certains éléments :</h4>
        <p class="muted">
            En cas de suppression d’un article, son image à la une sera effacée du site pour augmenter les performances. En revanche les images du contenu associées à cet article seront conservées, car elles pourraient être associées à d’autres articles, et nous voulons éviter de tout casser bien sûr ;)
        </p>
        <p class="muted">
            En cas de suppression d’une catégorie, tout comme pour les articles, son image à la une va aussi être effacée du serveur.
        </p>
        <p class="muted">
            En ce qui concerne les images et les documents pour le contenu des articles, leur suppression est normale. Ils vont tout simplement être effacés du serveur et donc ne pourront plus être associés aux articles. Donc attention avant d’en supprimer, vérifiez qu’aucun article ne les possède
        </p>
    </div>
    <div id="change-pwd" class="guide-group">
        <h2 class="alert">Gérer le mot de passe</h2>
        <hr>
        <h4>Pour gérer le mot de passe, c'est simple. Il faut :</h4>
        <ul>
            <li>Aller dans l’onglet “sécurité” de la navigation.</li>
            <li>Et là, vous rentrez 2 fois le nouveau mot de passe que vous désirez avoir.</li>
            <li>Et pour finir, cliquez sur “modifier” !</li>
        </ul>
        <h4 class="alert">Attention</h4>
        <h4 style="text-decoration: underline">Pour des questions de sécurité, il est préférable :</h4>
        <ul>
            <li>De changer de mot de passe fréquemment, (pas tous les jours non plus, mais quand même).</li>
            <li>De créer un mot de passe fort (avec des caractères spéciaux, des majuscules, pas trop court, des minuscules etc...)</li>
            <li>Et surtout, de ne pas l’oublier... ;)</li>
        </ul>
        <h4>Exemple : Tjdk&!&!dkjfsdf61312</h4>
    </div>

    <h2 id="md-guide">Guide d'écriture <strong>stylisée</strong></h2>
    <div class="mini-header">
        <p class="muted mb1">Voici le guide pour vous apprendre à écrire un texte stylisé pour le contenu de vos articles</p>
        <p class="alert">Attention, l'espace entre les caractères spéciaux et le texte est très important !<br>
            Exemple : #Titre est différent de # Titre
        </p>
    </div>
    <div class="guide-control">
        <h3 class="guide-control__title">Écrire un titre</h3>
        <div class="guide-control__content">
            <p># Titre</p>
            <p>## Titre</p>
            <p>### Titre</p>
            <p>#### Titre</p>
        </div>
    </div>
    <div class="guide-control">
        <h3 class="guide-control__title">Résultat</h3>
        <div class="guide-control__content">
            <h1 class="big-title">Titre</h1>
            <h2>Titre</h2>
            <h3 class="medium-title">Titre</h3>
            <h4>Titre</h4>
        </div>
    </div>
    <hr>
    <div class="guide-control">
        <h3 class="guide-control__title">Italique / Gras</h3>
        <div class="guide-control__content">
            <p>*Texte italique*</p>
            <p>**Texte Gras**</p>
            <p>***Texte italique et gras***</p>
        </div>
    </div>
    <div class="guide-control">
        <h3 class="guide-control__title">Résultat</h3>
        <div class="guide-control__content">
            <p class="italic">Texte italique</p>
            <strong class="bold">Texte Gras</strong> <br>
            <strong class="bold italic">Texte italique et gras</strong>
        </div>
    </div>
    <hr>
    <div class="guide-control">
        <h3 class="guide-control__title">Séparation</h3>
        <h4 class="muted">3 tirets minimum</h4>
        <div class="guide-control__content">
            <p>---</p>
        </div>
    </div>
    <div class="guide-control">
        <h3 class="guide-control__title">Résultat</h3>
        <div class="guide-control__content">
            <hr>
        </div>
    </div>
    <hr>
    <div class="guide-control">
        <h3 class="guide-control__title">Liste</h3>
        <div class="guide-control__content">
            <ul>
                <li>- Élément 1</li>
                <li>- Élément 2</li>
                <li>- Élément 3</li>
            </ul>
        </div>
    </div>
    <div class="guide-control">
        <h3 class="guide-control__title">Résultat</h3>
        <div class="guide-control__content">
            <ul class="list-circle">
                <li>Élément 1</li>
                <li>Élément 2</li>
                <li>Élément 3</li>
            </ul>
        </div>
    </div>
    <hr>
    <div class="guide-control">
        <h3 class="guide-control__title">Lien</h3>
        <div class="guide-control__content">
            <p>[Lien visible sur le site](https://example.com/ "titre de lien optionnel").</p>
        </div>
    </div>
    <div class="guide-control">
        <h3 class="guide-control__title">Résultat</h3>
        <div class="guide-control__content">
            <a href="#">Lien visible sur le site</a>
        </div>
    </div>
    <hr>
    <div class="guide-control">
        <h3 class="guide-control__title">Example d'article</h3>
        <div class="guide-control__content stack">
            <p># Voici un gros titre d'example</p>
            <p>## Voici un sous-titre d'example avec **texte gras de couleur**</p>
            <p>Voici un liste</p>
            <ul>
                <li>- élément 1</li>
                <li>- élément 2</li>
                <li>- élément 3</li>
            </ul>
            <p>### Ici un titre de section avec un mot en *italique*</p>
            <p>juste en dessous une séparation</p>
            <p>-------</p>
            <p>[Voici un lien qui ramène vers youtube](https://www.youtube.com/).</p>
            <p>------</p>
            <p>Mieux qu'un lien vers youtube, une vidéo intégrée facile à mettre, comme ceci</p>
            <p>https://www.youtube.com/watch?v=daFv-csZjjk</p>
            <p>Voilà le gros example pour mieux comprendre est fini !</p>
        </div>
    </div>
    <div class="guide-control">
        <h3 class="guide-control__title">Résultat</h3>
        <div class="guide-control__content stack">
            <h1 class="big-title" style="font-size: 40px">Voici un gros titre d'example</h1>
            <h2 class="section-title" style="font-size: 35px">Voici un sous-titre d'example avec <strong>texte gras de couleur</strong></h2>
            <p>Voici une liste</p>
            <ul class="list-circle">
                <li>Élément 1</li>
                <li>Élément 2</li>
                <li>Élément 3</li>
            </ul>
            <h3 class="medium-title">Ici un titre de section avec un mot en <em>italique</em></h3>
            <p>juste en dessous une séparation</p>
            <hr>
            <a href="https://www.youtube.com/">Voici un lien qui ramène vers youtube</a>
            <hr>
            <p>Mieux qu'un lien vers youtube, une vidéo intégrée facile à mettre, comme ceci</p>
            <iframe width="560" height="315" src="https://www.youtube.com/embed/daFv-csZjjk" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            <p>Voilà le gros example pour mieux comprendre est fini !</p>
        </div>
    </div>
</section>
