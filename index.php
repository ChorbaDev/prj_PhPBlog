<?php
session_start();
include_once "path.php";
include_once 'controlleur/sujet/implSujetDAO.php';
include_once 'controlleur/theme/implThemeDAO.php';
include_once 'controlleur/redacteur/implRedacteurDAO.php';
include_once 'modele/sujet.php';
$implSujetDao = new implSujetDAO();
$posts = array();
$implThemeDao = new implThemeDAO();
$themes = $implThemeDao->findAll();
$implRedacDao = new ImplRedacteurDAO();
$titrePost = 'Dernières Publications';
if (isset($_POST['recherche-mots'])) {
    $titrePost = 'Résultat de recherche pour : ' . $_POST['recherche-mots'];
    $posts = $implSujetDao->rechercher($_POST['recherche-mots']);
} else
    $posts = $implSujetDao->findAll();
if (isset($_GET['th'])) {
    $theme = $_GET['th'];
    $posts = $implSujetDao->getByTheme($theme);
}
?>
<!doctype html>
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
    <link rel="stylesheet" href="vue/cssfiles/guiAccueil.css">
    <!--    JS-->
    <script type="text/javascript" src="vue/javascriptfiles/carouselScript.js" async></script>
</head>
<body>
<?php
include ROOT_PATH . "/vue/phpfiles/Resources/header.php";
?>
<!--  Page Wrapper-->
<div class="page-wrapper">
    <!--        Carousel-->
    <div class="wrapper">
        <h1 class="title-slider">Nouveau Contenu</h1>
        <div id="carousel1">
            <?php foreach ($posts as $post):
                if ($post instanceof sujet && $post->getPublie() == 1):
                    $id = $post->getId();
                    $titre = $post->getTitreSujet();
                    $date = $post->getDateSujet();
                    $texte = substr($post->getTexteSujet(), 0, 100);
                    $image = $post->getImage();
                    $nomredac = $implRedacDao->getByID($post->getIdRedacteur())->getPseudo();

                    ?>
                    <div class="post">
                        <div class="post__image">
                            <?php
                            if ($image)
                                echo '<img src="data:image/jpeg;base64,' . base64_encode($image) . '" alt="" />';
                            else echo "<img src='vue/images/placeholder.png' alt='' />";
                            ?>
                        </div>
                        <div class="post__body">
                            <div class="post__title">
                                <a href="<?php echo(BASE_URL . "/vue/phpfiles/Blog/viewBlog.php?id=" . $id); ?>"><?php echo $titre; ?></a>
                            </div>
                            <div class="post__desc">
                                <div><i class="far fa-user"><?php echo $nomredac; ?></i>
                                    <i class="far fa-calendar"><?php echo date(' j/n/Y', strtotime($date)); ?></i>
                                </div>
                                <?php echo html_entity_decode($texte . '...') ?>
                            </div>
                        </div>
                    </div>
                <?php
                endif;
            endforeach;
            ?>
        </div>
    </div>
    <!--        Fin Carousel-->

    <!--        Contenu-->
    <div class="content clearfix">
        <div class="content__main">
            <h1 class="post__titre__recent"><?php echo $titrePost ?></h1>
            <?php foreach ($posts as $post):
                if ($post instanceof sujet && $post->getPublie() == 1):
                    $id = $post->getId();
                    $titre = $post->getTitreSujet();
                    $date = $post->getDateSujet();
                    $publie = $post->getPublie();
                    $texte = substr($post->getTexteSujet(), 0, 200);
                    $image = $post->getImage();
                    $nomredac = $implRedacDao->getByID($post->getIdRedacteur())->getPseudo();
                    ?>
                    <div class="post clearfix">
                        <div class="post__image">
                            <?php
                            if ($image)
                                echo '<img src="data:image/jpeg;base64,' . base64_encode($image) . '" alt="" />';
                            else echo "<img src='vue/images/placeholder.png' alt='' />";
                            ?>
                        </div>
                        <div class="post__preview">
                            <h2>
                                <a href="<?php echo(BASE_URL . "/vue/phpfiles/Blog/viewBlog.php?id=" . $id); ?>"><?php echo $titre; ?></a>
                            </h2>
                            <i class="far fa-user"><?php echo $nomredac; ?></i>
                            <i class="far fa-calendar"><?php echo date(' j/n/Y', strtotime($date)); ?></i>
                            <p class="preview"><?php echo html_entity_decode($texte . '...') ?></p>
                            <a href="<?php echo(BASE_URL . "/vue/phpfiles/Blog/viewBlog.php?id=" . $id); ?>"
                               class="btn lire">Lire</a>
                        </div>
                    </div>
                <?php
                endif;
            endforeach;
            ?>
        </div>
        <div class="sidebar">
            <div class="section search">
                <h2 class="section__titre">Rechercher</h2>
                <form action="" method="post"><input type="text" name="recherche-mots" class="text-input"
                                                     placeholder="Rechercher"></form>

            </div>
            <div class="section theme">
                <h2 class="section__titre">Thèmes</h2>
                <ul>
                    <?php
                    foreach ($themes as $theme)
                        echo '<li><a href=index.php?th=' . $theme . '>' . $theme . '</a></li>';
                    ?>
                </ul>

            </div>
        </div>
    </div>
    <!--        Fin Contenu-->
</div>
<!--  Fin Page Wrapper-->
</body>
</html>
