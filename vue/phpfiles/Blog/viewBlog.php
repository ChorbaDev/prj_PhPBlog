<?php
session_start();
include_once "/home/elloumi2u/Projet/path.php";
include_once ROOT_PATH . "/controlleur/sujet/implSujetDAO.php";
include_once ROOT_PATH . "/controlleur/redacteur/implRedacteurDAO.php";
include_once ROOT_PATH . "/controlleur/reponse/implReponseDAO.php";
include_once ROOT_PATH . "/modele/sujet.php";
include_once ROOT_PATH . "/modele/reponse.php";


$implRepDao = new implReponseDAO();
$implSujetDao = new implSujetDAO();
$implRedacDao = new ImplRedacteurDAO();
if (isset($_SESSION['pseudo']))
    $idCo = $implRedacDao->getByPseudo($_SESSION['pseudo'])->getId();

if (isset($_GET['id']) || $implSujetDao->getById($_GET['id'])->getPublie() === 1) {
    $post = $implSujetDao->getById($_GET['id']);

} else {
    header("Location: " . BASE_URL . "/index.php");
}
$id = $post->getId();
$titre = $post->getTitreSujet();
$date = $post->getDateSujet();
$texte = $post->getTexteSujet();
$image = $post->getImage();
$nomredac = $implRedacDao->getByID($post->getIdRedacteur())->getPseudo();
$uri = $_SERVER['PHP_SELF'] . "?id=$id";
$posts = array();
$reps = array();

$posts = $implSujetDao->findAll();
$reps = $implRepDao->findAll();
if (isset($_GET['m'])) {
    $placeHolderRep = $implRepDao->getByID($_GET['idRep'])->getTexteReponse();
    if (isset($_POST['btn-post'])) {
        if (!isset($_SESSION['pseudo'])) {
            header("Location: " . BASE_URL . "/vue/phpfiles/Connexion/Login/login.php");
        } else {
            $text = $_POST['body'];
            if (!$text == null) {
                $nRep = new reponse(0, $id, $implRedacDao->getByPseudo($_SESSION['pseudo'])->getId(), $date, $text);
                $implRepDao->update($_GET['idRep'], $nRep);
                header('Location: ' . $uri);
            }
        }
    }


} else if (isset($_GET['d'])) {
    $implRepDao->delete($_GET['idRep']);
    header('Location: ' . $uri);
} else {
    $placeHolderRep = '';
    if (isset($_POST['btn-post'])) {
        if (!isset($_SESSION['pseudo'])) {
            header("Location: " . BASE_URL . "/vue/phpfiles/Connexion/Login/login.php");
        } else {
            $text = $_POST['body'];
            if (!$text == null) {
                $nRep = new reponse(0, $id, $implRedacDao->getByPseudo($_SESSION['pseudo'])->getId(), $date, $text);
                $implRepDao->create($nRep);
                header('Location: ' . $uri);
            }
        }
    }
}

?>

    <!doctype html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>

        <link rel="shortcut icon" href="#">

        <!--    Font Awesome-->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
              integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm"
              crossorigin="anonymous">
        <!--    Google Fonts-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap"
              rel="stylesheet">

        <!--    CSS-->
        <link rel="stylesheet" href="../../cssfiles/guiViewBlog.css">
        <link rel="stylesheet" href="../../cssfiles/guiBlog.css">
        <!--    JS-->
        <script type="text/javascript" src="../../javascriptfiles/carouselScript.js" async></script>
    </head>
    <body>
    <?php
    include ROOT_PATH . "/vue/phpfiles/Resources/header.php";
    ?>
    <div class="page-wrapper">
        <div class="content clearfix">
            <div class="content__main">
                <div class="sujet__wrapper">
                    <div class="sujet__titre">
                        <h1 class=""><?php echo $titre ?></h1>
                    </div>
                    <div class="sujet__info">
                        <i class="far fa-user"><?php echo $nomredac; ?></i>
                        <i class="far fa-calendar"><?php echo date(' j/n/Y', strtotime($date)); ?></i>
                    </div>
                    <div class="sujet clearfix">
                        <div class="sujet__image"><?php
                            if ($image)
                                echo '<img src="data:image/jpeg;base64,' . base64_encode($image) . '" alt="" />';
                            else echo "<img src='../../images/placeholder.png' alt='' />";
                            ?></div>
                        <div class="sujet__contenu"><?php echo $texte ?></div>
                    </div>
                </div>
                <div class="reponse__wrapper">
                    <div class="rep__ajout__wrapper">
                        <h2>Donnez votre avis</h2>
                        <div class="rep__ajout">
                            <form action="" method="post">
                                <div>
                                    <label><?php echo '' ?></label>
                                    <textarea name="body" id="body"><?php echo $placeHolderRep ?></textarea>
                                </div>
                                <div>
                                    <button type="submit" name="btn-post" class="btn btn-big">Valider</button>
                                </div>
                            </form>
                        </div>


                    </div>
                    <?php foreach ($reps as $rep):
                        if ($rep instanceof reponse && $rep->getIdSujet() == $id):
                            $idRep = $rep->getId();
                            $idCoRep = $rep->getIdRedacteur();
                            $texteRep = $rep->getTexteReponse();
                            $dateRep = $rep->getDateRep();
                            $nomredacRep = $implRedacDao->getByID($rep->getIdRedacteur())->getPseudo();
                            ?>


                            <div class="rep clearfix">
                                <div class="rep__info">
                                    <i class="far fa-user"><?php echo $nomredacRep; ?></i>
                                    <i class="far fa-calendar"><?php echo date(' j/n/Y', strtotime($dateRep)); ?></i>
                                </div>
                                <div class="rep__contenu">
                                    <?php echo $texteRep; ?>
                                </div>
                                <?php if (isset($_SESSION['pseudo'])):
                                    if ($idCo == $idCoRep): ?>
                                        <div class="modif">
                                            <a href="<?php echo($uri . '&m&idRep=' . $idRep); ?>">Modifier</a>
                                        </div>
                                        <div class="modif">
                                            <a href="<?php echo($uri . '&d&idRep=' . $idRep); ?>">Supprimer</a>
                                        </div>
                                    <?php endif; endif; ?>
                            </div>
                        <?php
                        endif;
                    endforeach;
                    ?>
                </div>


            </div>
        </div>
    </div>
    <!-- Ckeditor -->
    <script src="https://cdn.ckeditor.com/ckeditor5/12.2.0/classic/ckeditor.js"></script>
    <!-- Custom Script -->
    <script src="../../javascriptfiles/textAreaScript.js"></script>

    </body>
    </html>
<?php
