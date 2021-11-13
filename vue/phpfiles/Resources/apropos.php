<?php
session_start();
include "/home/elloumi2u/Projet/path.php";
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>A propos</title>

    <!--    Font Awesome-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
          integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <!--    Google Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap"
          rel="stylesheet">
    <!--    CSS-->
    <link rel="stylesheet" href="../../cssfiles/guiAccueil.css">
    <link rel="stylesheet" href="../../cssfiles/guiAPropos.css">
</head>
<body>
<?php
include_once "header.php";
?>
<div class="page-wrapper">
    <div class="post">
        <div class="post__title">
            <h1 class="center">The Blog, qu'est-ce que c'est ?</h1>
        </div>
        <div class="post__body">
            <p>Ce site est site de blogs permettant de publier différentes publications sur des themes différents et
                avoir
                un retour
                sur le sujet.</p>
            <p>Ce site permet la recherche de sujets et son affichage en fonction de son nombre d'intéractions, il est
                aussi
                possible de classer les sujets en fonctions de leurs thèmes</p>
            <p>Les personnes ayant publié un blog peuvent poster des images et styliser leur texte, ils peuvent aussi
                modifier une
                ancienne publication, la supprimer ou la dé publier.</p>
            <p>Un visiteur lambda [sans compte] peut rendre visite au site et lire les articles, il faut avoir un compte
                pour
                modifier ses réponses et publier des sujets</p>
            <p>Le role administrateur est pris en compte, celui-ci peut ajouter des thèmes et modérer les publications
                existantes.</p>
        </div>
    </div>
    <div class="post">
        <div class="post__title">
            <h1 class="center">Qui ?</h1>
        </div>
        <div class="post__body">
            <p>La mise en oeuvre de ce site à été permise grace à Omar Elloumi et Younes Ghoniem étudiants de 2A en DUT
                Informatique
                à Metz.</p>
        </div>
    </div>
    <div class="post">
        <div class="post__title">
            <h1 class="center">Comment ?</h1>
        </div>
        <div class="post__body">
            <p>Les languages utilisés pour ce projet sont, évidemment l'HTML et le CSS, sont très utilisé aussi le PHP
                et le
                JavaScript d'un coté pour la gestion du dynamisme et pour l'autre des animations.</p>
        </div>
    </div>
</div>

</body>
</html>
