<?php
    session_start();
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
    <link rel="stylesheet" href="../cssfiles/guiRegisterLogin.css">
</head>
<body>
<?php
include "header.php";
?>
<table>
    <tr>
        <th>Titre</th>
        <th>Texte</th>
        <th>theme</th>
    </tr>
    <?php
        foreach($posts as $post){
            if($post instanceof sujet){
                $titre=$post->getTitreSujet();
                $text=$post->getTexteSujet();
                $post=$post->getTheme();
                echo "<tr>";
                echo "<td>$titre</td>";
                echo "<td>$text</td>";
                echo "<td>$post</td>";
                echo "</tr>";
            }
        }
    ?>
</table>
</body>
</html>
