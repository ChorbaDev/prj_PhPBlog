<!doctype html>
<?php
session_start();
?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Accueil - Blog</title>

    <link rel="shortcut icon" href="#">

    <!--    Font Awesome-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
          integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <!--    Google Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap"
          rel="stylesheet">

    <!--    CSS-->
    <link rel="stylesheet" href="../cssfiles/guiAccueil.css">
    <!--    JS-->
    <script type="text/javascript" src="../javascriptfiles/includeHTML.js"></script>

    <script type="text/javascript" src="../javascriptfiles/carouselScript.js" async></script>
</head>
<body>
<?php
include "header.php";
?>
<!--  Page Wrapper-->
<div class="page-wrapper">
    <!--        Carousel-->
    <div class="wrapper">
        <h1 class="title-slider">Nouveau Contenu</h1>
        <div id="carousel1">
            <div class="post">
                <div class="post__image">
                    <img src="../images/dbbb.png" alt="">
                </div>
                <div class="post__body">
                    <div class="post__title">1</div>
                    <div class="post__desc">azdazda</div>
                </div>
            </div>
            <div class="post">
                <div class="post__image">
                    <img src="../images/dbbb.png" alt="">
                </div>
                <div class="post__body">
                    <div class="post__title">2</div>
                    <div class="post__desc">feazf</div>
                </div>
            </div>
            <div class="post">
                <div class="post__image">
                    <img src="../images/dbbb.png" alt="">
                </div>
                <div class="post__body">
                    <div class="post__title">3</div>
                    <div class="post__desc">fezfzeze</div>
                </div>
            </div>
            <div class="post">
                <div class="post__image">
                    <img src="../images/dbbb.png" alt="">
                </div>
                <div class="post__body">
                    <div class="post__title">4</div>
                    <div class="post__desc">fezfzeze</div>
                </div>
            </div>
            <div class="post">
                <div class="post__image">
                    <img src="../images/dbbb.png" alt="">
                </div>
                <div class="post__body">
                    <div class="post__title">5</div>
                    <div class="post__desc">fezfzeze</div>
                </div>
            </div>
            <div class="post">
                <div class="post__image">
                    <img src="../images/M-Aillerie.jpg" alt="">
                </div>
                <div class="post__body">
                    <div class="post__title">6</div>
                    <div class="post__desc">fezfzeze</div>
                </div>
            </div>
        </div>
    </div>
    <!--        Fin Carousel-->

    <!--        Contenu-->
    <div class="content clearfix">
        <div class="content__main">
            <h1 class="post__titre__recent">Dernières Publications</h1>
            <div class="post">
                <div class="post__image">
                    <img src="../images/M-Aillerie.jpg" alt="">
                </div>
                <div class="post__preview">
                    <h2><a href="">aillerie waf waf</a></h2>
                    <i class="far fa-user"></i>
                    <i class="far calendar"></i>
                    <p class="preview">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet at excepturi odit omnis soluta voluptatem.</p>
                    <a href="" class="btn lire">Lire</a>
                </div>
            </div>
            <div class="post">
                <div class="post__image">
                    <img src="../images/M-Aillerie.jpg" alt="">
                </div>
                <div class="post__preview">
                    <h2><a href="">aillerie waf waf</a></h2>
                    <i class="far fa-user"></i>
                    <i class="far calendar"></i>
                    <p class="preview">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet at excepturi odit omnis soluta voluptatem.</p>
                    <a href="" class="btn lire">Lire</a>
                </div>
            </div>
            <div class="post">
                <div class="post__image">
                    <img src="../images/M-Aillerie.jpg" alt="">
                </div>
                <div class="post__preview">
                    <h2><a href="">aillerie waf waf</a></h2>
                    <i class="far fa-user"></i>
                    <i class="far calendar"></i>
                    <p class="preview">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet at excepturi odit omnis soluta voluptatem.</p>
                    <a href="" class="btn lire">Lire</a>
                </div>
            </div>
            <div class="post">
                <div class="post__image">
                    <img src="../images/M-Aillerie.jpg" alt="">
                </div>
                <div class="post__preview">
                    <h2><a href="">aillerie waf waf</a></h2>
                    <i class="far fa-user"></i>
                    <i class="far calendar"></i>
                    <p class="preview">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet at excepturi odit omnis soluta voluptatem.</p>
                    <a href="" class="btn lire">Lire</a>
                </div>
            </div>
        </div>
        <div class="sidebar">
            <div class="section search">
                <h2 class="section__titre">Rechercher</h2>
                <form action="" method="post"><input type="text" name="recherche-mots" class="text-input" placeholder="Rechercher"></form>

            </div>
            <div class="section theme">
                <h2 class="section__titre">Sujets</h2>
                    <ul>
                        <li><a href="">1</a></li>
                        <li><a href="">2</a></li>
                        <li><a href="">3</a></li>
                        <li><a href="">4</a></li>
                        <li><a href="">5</a></li>
                        <li><a href="">6</a></li>
                    </ul>

            </div>
        </div>
    </div>
    <!--        Fin Contenu-->
</div>
<!--  Fin Page Wrapper-->
</body>
<script>
    includeHTML();
</script>
</html>
