<?php

use App\Auth;

Auth::check();
?>

<section class="guide">
    <h1 class="section-title">Guide d'écriture <strong>simplifiée</strong></h1>
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
            <p>Lien visible sur le site</p>
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
