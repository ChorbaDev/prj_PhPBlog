<?php
    session_start();
    include "/home/elloumi2u/Projet/path.php";
    include_once ROOT_PATH."/controlleur/sujet/implSujetDAO.php";
    include_once ROOT_PATH."/controlleur/theme/implThemeDAO.php";
    include_once ROOT_PATH."/controlleur/redacteur/implRedacteurDAO.php";
    include_once ROOT_PATH."/modele/sujet.php";
    $implR=new ImplRedacteurDAO();
    $implT=new ImplThemeDAO();
    $impl=new ImplSujetDAO();
    if(isset($_SESSION['pseudo']))
        $id=$implR->getByPseudo($_SESSION['pseudo'])->getId();
    $listTH=array();
    if(isset($_GET['b'])){
        $_SESSION['url']='dashboard.php?b';
        $posts=$impl->getByIdRedacteur($id);
        array_push($listTH,"<th>Titre</th>");
        array_push($listTH,"<th>Date</th>");
        array_push($listTH,"<th>Thème</th>");
        array_push($listTH,"<th colspan='3'>Action</th>");
    }
    if(isset($_GET['t'])){
        $_SESSION['url']='dashboard.php?t';
        $themes=$implT->findAll();
        array_push($listTH,"<th>Libellé</th>");
        array_push($listTH,"<th colspan='2'>Action</th>");
    }
    if(isset($_GET['r'])){
        $_SESSION['url']='dashboard.php?r';
        $redacteurs=$implR->findAll();
        array_push($listTH,"<th>Pseudo</th>");
        array_push($listTH,"<th>Nom & Prénom</th>");
        array_push($listTH,"<th >Adresse mail</th>");
        array_push($listTH,"<th colspan='3'>Action</th>");
        array_push($listTH,"<th>Consulter</th>");
    }
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tableau de bord</title>
    <link rel="stylesheet" href="../../cssfiles/guiDashboard.css">
    <!--    Font Awesome-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <!--    Google Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
</head>
<body>
<?php
include_once "header.php";
?>
<div class="admin-wrapper">
    <?php
        if(isset($_SESSION['admin']))
            include_once ROOT_PATH."/vue/phpfiles/Admin/adminSideBar.php";
        ?>

<table>
    <thead>
    <tr>
        <?php foreach($listTH as $th){
            echo $th;
        }
        ?>
    </tr>
    </thead>
    <tbody>
    <?php
    if(isset($_GET['b'])):
        if(isset($_GET['id'])){
            $posts=$impl->getByIdRedacteur($_GET['id']);
        }
        foreach ($posts as $post) {
            if ($post instanceof sujet) {
                $titre = $post->getTitreSujet();
                $date = $post->getDateSujet();
                $theme = $post->getTheme();
                $publie = $post->getPublie();
                $id = $post->getId();
                echo "<tr>";
                echo "<td>$titre</td>";
                echo "<td>$date</td>";
                echo "<td>$theme</td>";
                echo '
                <td> <a href="'.BASE_URL.'/vue/phpfiles/Blog/editBlog.php?m&id=' . $id . '&idR='.$post->getIdRedacteur().'" class="edit" >éditer</a> </td>
                <td> <a href="'.BASE_URL.'/vue/phpfiles/Blog/editBlog.php?s&id=' . $id . '&idR='.$post->getIdRedacteur().'" class="supprimer" >supprimer</a> </td>
                  ';
                if ($publie != 1)
                    echo '<td> <a href="'.BASE_URL.'/vue/phpfiles/Blog/editBlog.php?p&id=' . $id . '&idR='.$post->getIdRedacteur().'" class="publier" >publier</a> </td>';
                else
                    echo '<td> <a href="'.BASE_URL.'/vue/phpfiles/Blog/editBlog.php?p&id=' . $id . '&idR='.$post->getIdRedacteur().'" class="depublier" >dépublier</a> </td>';
                echo "</tr>";
             }
            }

     endif;
        if(isset($_GET['r'])):
            foreach($redacteurs as $redact):
                if (($redact instanceof redacteur)):
                    $pseudo=$redact->getPseudo();
                    $np=$redact->getNom().' '.$redact->getPrenom();
                    $mail=$redact->getMail();
                    if($pseudo!=$_SESSION['pseudo']):
                    echo "<tr>";
                    echo "<td>$pseudo</td>";
                    echo "<td>$np</td>";
                    echo "<td>$mail</td>";
                    echo '
                    <td> <a href="'.BASE_URL.'/vue/phpfiles/Inscription_ModifRedact/formulaireRedacteur.php?p&id=' .$redact->getId(). '" class="edit" >éditer</a> </td>
                    <td> <a href="'.BASE_URL.'/vue/phpfiles/Inscription_ModifRedact/formulaireRedacteur.php?s&id=' .$redact->getId(). '" class="supprimer" >supprimer</a> </td>
                    ';
                    if($implR->isAdmin($pseudo))
                        echo '<td> <a href="'.BASE_URL.'/vue/phpfiles/Inscription_ModifRedact/formulaireRedacteur.php?ad&id=' .$redact->getId(). '" class="depublier" >Non Admin</a> </td>';
                    else
                        echo '<td> <a href="'.BASE_URL.'/vue/phpfiles/Inscription_ModifRedact/formulaireRedacteur.php?ad&id=' .$redact->getId(). '" class="publier" >Admin</a> </td>';
                        echo '<td> <a href="dashboard.php?b&id=' .$redact->getId(). '" class="depublier" >Blogs</a> </td>';
                    echo "</tr>";
                    endif;

                endif;
            endforeach;
        endif;
    if(isset($_GET['t'])):
        foreach($themes as $theme):
                echo "<tr>";
                echo "<td>$theme</td>";
                echo '
                    <td> <a href="'.BASE_URL.'/vue/phpfiles/Admin/editTheme.php?m&th=' .$theme. '" class="edit" >éditer</a> </td>
                    <td> <a href="'.BASE_URL.'/vue/phpfiles/Admin/editTheme.php?s&th=' .$theme. '" class="supprimer" >supprimer</a> </td>
                    ';
                echo "</tr>";
        endforeach;
    endif;
    ?>
    <tr>
        <td colspan="6">
            <?php
            if(!isset($_SESSION['admin'])){
                echo '<a class="btn btnAj" href="'.BASE_URL.'/vue/phpfiles/Blog/editBlog.php">Ajouter un blog</a>';
            }
            ?>
        </td>
    </tr>
    </tbody>
</table>
</div>
</body>
</html>
