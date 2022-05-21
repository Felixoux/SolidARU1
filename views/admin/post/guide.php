<?php

use App\Auth;

Auth::check();
?>

<section class="guide">
    <h1 class="big-title"><strong>Guide</strong> d'administration du site</h1>
    <h2>Sommaire</h2>
    <ul class="summary-titles">
        <li><h3 class="medium-title"><a href="#login">1. Connection/déconnection</a></h3></li>
        <li><h3 class="medium-title"><a href="#create-article">2. Créer un article</a></h3></li>
        <li><h3 class="medium-title"><a href="#">3. Créer une catégorie</a></h3></li>
        <li><h3 class="medium-title"><a href="#">4. Ajouter des fichiers</a></h3></li>
        <li><h3 class="medium-title"><a href="#">5. Suppression des éléments</a></h3></li>
        <li><h3 class="medium-title"><a href="#">6. Gérer le mot de passe</a></h3></li>
    </ul>

    <div id="login" class="guide-group">

    <h2>Connection/déconnection</h2>
    <hr>
    <h4>Pour se connecter il faut: </h4>
    <ul>
        <li>Taper “/admin” à la fin du l’url de l’accueil, soit “felixoux.alwaysdata.net”.
            Ce qui donne “felixoux.alwaysdata.net/admin”.</li>
        <li>Ensuite entrez le nom d’utilisateur, par défaut “admin”.</li>
        <li>Et entrez le mot de passe, par défaut “admin”.</li>
        <li>Vous pouvez éventuellement cliquer sur “RESET CONNECTER”.
            Cela va retenir votre état de connection pendant plusieurs jours, plus pratique
            que se connecter tout le temps.
        </li>
    </ul>
    <h4>Une fois connecté :</h4>
    <ul>
        <li>Vous avez maintenant accès au panel administration ainsi que sa naviguation. </li>
        <li>Pour revenir sur le site normal (celui que l’utilisateur standart vois), cliquez sur la maison
            dans la navigution. </li>
        <li>Vous aurez aussi un nouvel onglet “admin” qui apparaitera dans la naviguation
            du site standart une fois connecté.
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
        <h4>Pour créer un article, il vous faut faire :</h4>
        <ul>
            <li>Aller dans l’onglet “article” de la naviguation et cliquer sur le bouton “ajouter un article”</li>
            <li>Entrer d’abord le titre de l’article tout simplement.</li>
            <li>Ensuite vous pouvez rentrez une URL personnalisée. Par defaut elle se complète toute seule avec le nom de l’article.</li>
            <li>Ensuite vous pouvez écrire du contenu, si vous désirez stylisé le contenu, voici comment faire.</li>
            <li>Vous devez maintenant associer l’article à une ou plusieurs catégorie.</li>
        </ul>
        <h4>Maintenant pour les champs optionnels :</h4>
        <ul>
            <li>Vous pouvez ajouter une image à la une, cette image apparaitra sur la carte de l’article.</li>
            <li>Vous pouvez associés de multiples images au contenu de l’article en les séléctionnant. </li>
            <li>L’association des documents fonctionne comme les images. </li>
            <li>Vous n’avez pas d’images à associer ? C’est normal, il faut mettre en ligne. Voir ici comment mettre en lignes
                les images et les documents.</li>
            <li>Vous pouvez choisir la date de publication de l’article en dernier. Par defaut la date sera celle du jour actuel.</li>
        </ul>
        <h4>Et maintenant, cliquez sur le bouton “ajouter” !</h4>
    </div>



    <h2>Guide d'écriture <strong>simplifiée</strong></h2>
    <p class="alert">Attention, l'espace entre les caractères spéciaux et le texte est très important !<br>
        Exemple : #Titre est différent de # Titre
    </p>
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
            <h1>Titre</h1>
            <h2>Titre</h2>
            <h3>Titre</h3>
            <h4>Titre</h4>
        </div>
    </div>
    <hr>
    <div class="guide-control">
        <h3 class="guide-control__title">Séparation</h3>
        <div class="guide-control__content">
            <p>----------</p>
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
        <h3 class="guide-control__title">Italique / Gras</h3>
        <div class="guide-control__content">
            <p>*Texte italique*</p>
            <p>**Texte Gras**</p>
            <p>***Texte italique et gras***</p>
        </div>
    </div>
    <div class="guide-control">
        <h3 class="guide-control__title">Résulat</h3>
        <div class="guide-control__content">
            <p class="italic">Texte italique</p>
            <p class="bold">Texte Gras</p>
            <p class="italic bold">Texte italique et gras</p>
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
        <h3 class="guide-control__title">Tableau</h3>
        <div class="guide-control__content">
            <p>|cellule 1|cellule 2|</p>
            <p>|--------|--------|</p>
            <p>| A | B |</p>
            <p>| C | D |</p>
        </div>
    </div>
    <div class="guide-control">
        <h3 class="guide-control__title">Résultat</h3>
        <div class="guide-control__content">
            <table>
                <thead>
                <tr>
                    <th colspan="2">Cellule 1</th>
                    <th colspan="2">Cellule 2</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>A</td>
                    <td>C</td>
                </tr>
                <tr>
                    <td>B</td>
                    <td>D</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <hr>
    <div class="guide-control">
        <h3 class="guide-control__title">Citation</h3>
        <div class="guide-control__content">
            <p>> Ceci est une citation de John Doe</p>
        </div>
    </div>
    <div class="guide-control">
        <h3 class="guide-control__title">Résultat</h3>
        <div class="guide-control__content">
            <blockquote> "Ceci est une citation de John Doe"</blockquote>
        </div>
    </div>
    <hr>
    <div class="guide-control">
        <h3 class="guide-control__title">Changer de couleur de fond</h3>
        <div class="guide-control__content">
            <p>`Texte fond clair`</p>
        </div>
    </div>
    <div class="guide-control">
        <h3 class="guide-control__title">Résultat</h3>
        <div class="guide-control__content guide-control__content--code">
            <code>Texte fond clair</code>
        </div>
    </div>
</section>
