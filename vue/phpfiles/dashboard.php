<?php
    session_start();
    $_SESSION['url']='dashboard.php';
    include_once "../../controlleur/sujet/implSujetDAO.php";
    include_once "../../controlleur/redacteur/implRedacteurDAO.php";
    include_once "../../modele/sujet.php";
    $implR=new ImplRedacteurDAO();
    $impl=new ImplSujetDAO();
    $id=$implR->getByPseudo($_SESSION['pseudo'])->getId();
    $posts=$impl->getByIdRedacteur($id);
?>
<html>
<head>
    <title>Tableau de bord</title>
    <link rel="stylesheet" href="../cssfiles/dashboard.css">
    <!--    Font Awesome-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <!--    Google Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
</head>
<body>
<?php
include "header.php";
?>

    <a href="editBlog.php?a" class="btn btn-big">Ajouter un blog</a>

<table>
    <thead>
    <tr>
        <th>Titre</th>
        <th>Date</th>
        <th>théme</th>
        <th colspan="3">Action</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach($posts as $post){
        if($post instanceof sujet){
            $titre=$post->getTitreSujet();
            $date=$post->getDateSujet();
            $theme=$post->getTheme();
            $publie=$post->getPublie();
            $id=$post->getId();
            echo "<tr>";
            echo "<td>$titre</td>";
            echo "<td>$date</td>";
            echo "<td>$theme</td>";
            echo '
                <td> <a href="editBlog.php?m&id='.$id.'" class="edit" >éditer</a> </td>
                <td> <a href="editBlog.php?s&id='.$id.'" class="supprimer" >supprimer</a> </td>
                  ';
            if($publie!=1)
                echo '<td> <a href="editBlog.php?p&id='.$id.'" class="publier" >publier</a> </td>';
            else
                echo '<td> <a href="editBlog.php?p&id='.$id.'" class="depublier" >dépublier</a> </td>';
            echo "</tr>";
        }
    }
    ?>
    </tbody>
</table>
</body>
</html>
