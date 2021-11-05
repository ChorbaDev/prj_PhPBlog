<?php
session_start();
include_once "../../controlleur/redacteur/implRedacteurDAO.php";
include_once "../../modele/redacteur.php";
require_once "submitSignUp.php";
$impl=new ImplRedacteurDAO();
$redacteur=$impl->getByPseudo($_SESSION['pseudo']);
//
$pseudo=$redacteur->getPseudo();
$nom=$redacteur->getNom();
$prenom=$redacteur->getPrenom();
$mail=$redacteur->getMail();
$mdp='';
$err='';
$confMdp='';
if(isset($_POST["register"])){
    $pseudo=$_POST['pseudo'];
    $mail=$_POST['mail'];
    $nom=$_POST['nom'];
    $prenom=$_POST['prenom'];
    $mdp=$_POST['mdp'];
    $confMdp=$_POST['mdpC'];
    $verified=verifier($pseudo,$nom,$prenom,$mail,$mdp,$confMdp);
    if($verified){
        $redacteur2=new Redacteur(0,$nom,$prenom,$mail,$mdp,$pseudo);
        $impl=new ImplRedacteurDAO();
        if($redacteur->getMail()!=$mail  || $redacteur->getPseudo()!=$pseudo){
            if($redacteur->getMail()!=$mail && $impl->getByMail($mail)!=NULL) {
                echo "<script type='text/javascript'>
            alert('Cette mail existe déja! ');
            </script>";
                $err = $err . "Cette mail existe déja!<br>";
            }else if($redacteur->getPseudo()!=$pseudo && $impl->getByPseudo($pseudo)!=NULL){
                echo "<script type='text/javascript'>
                alert('Ce pseudo existe déja!');
            </script>";
                $err=$err."Ce pseudo existe déja!<br>";
            }
            else{
                $impl->update($redacteur->getId(),$redacteur2);
                $_SESSION['pseudo']=$pseudo;
                header('Location: accueil.php');
            }
        }
        else{
            $impl->update($redacteur->getId(),$redacteur2);
            $_SESSION['pseudo']=$pseudo;
            header('Location: accueil.php');
        }
    }else{
        if(!verifPseudo($pseudo)) $err=$err."Le champ pseudo est obligatoire!<br>";
        if(!verifNom($nom)) $err=$err."Vérifier votre nom!<br>";
        if(!verifPrenom($prenom)) $err=$err."Vérifier votre prénom!<br>";
        if(!verifMail($mail)) $err=$err."Vérifier votre mail!<br>";
        if(!verifMdp($mdp))$err=$err."Votre mot de passe est faible!<br>";
        if(!verifConfMdp($confMdp,$mdp))$err=$err."Vérifier le champ de vérification de mot de passe!<br>";
    }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Créer un compte</title>
    <!--    Font Awesome-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <!--    Google Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <!--    CSS-->
    <link rel="stylesheet" href="../cssfiles/guiRegisterLogin.css">
</head>
<body>
<?php
include "header.php";
?>
<center>
    <noscript>
        <?php
        echo $err;
        ?>
    </noscript>
</center>


<div class="form-content">
    <form autocomplete="off" class="form" action="" method="post">
        <h2 class="form-title">Paramétre du compte</h2>
        <div class="form-control">
            <label>Pseudo</label>
            <input type="text" id="pseudo" name="pseudo" value="<?php echo $pseudo?>" class="text-input">
            <i class="fas fa-check-circle"></i>
            <i class="fas fa-exclamation-circle"></i>
            <small></small>

        </div>
        <div class="form-control">
            <label>Nom</label>
            <input type="text" id="nom" name="nom" value="<?php echo $nom?>" class="text-input">
            <i class="fas fa-check-circle"></i>
            <i class="fas fa-exclamation-circle"></i>
            <small></small>
        </div>
        <span id="pr"></span>
        <div class="form-control">
            <label>Prénom</label>
            <input type="text" id="prenom" name="prenom" value="<?php echo $prenom?>"class="text-input">
            <i class="fas fa-check-circle"></i>
            <i class="fas fa-exclamation-circle"></i>
            <small></small>
        </div>
        <div class="form-control">
            <label>Adresse mail</label>
            <input  type="email" id="mail" value="<?php echo $mail?>" name="mail" class="text-input">
            <i class="fas fa-check-circle"></i>
            <i class="fas fa-exclamation-circle"></i>
            <small></small>
        </div>
        <div class="form-control pass">
            <label>Mot de passe</label>
            <input type="password" id="mdp" name="mdp" class="text-input">
            <div id="toggle"></div>
            <i class="fas fa-check-circle"></i>
            <i class="fas fa-exclamation-circle"></i>
            <small></small>
        </div>
        <div class="form-control">
            <label>Confirmation de Mot de passe</label>
            <input type="password" id="mdpConf" name="mdpC" class="text-input">
            <i class="fas fa-check-circle"></i>
            <i class="fas fa-exclamation-circle"></i>
            <small></small>
        </div>
        <div>
            <input type="submit" id="register" value="Modifier" name="register" class="btn">
        </div>
    </form>
</div>

</body>
<script type="text/javascript" src="../javascriptfiles/signup.js"></script>
</html>