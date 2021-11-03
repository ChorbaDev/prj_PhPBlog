<?php
session_start();
include_once "../../controlleur/redacteur/implRedacteurDAO.php";
include_once "../../modele/redacteur.php";
$pseudo='';
$nom='';
$prenom='';
$mail='';
$mdp='';
if(isset($_POST["submit"])){
    $pseudo=$_POST['pseudo'];
    $nom=$_POST['nom'];
    $prenom=$_POST['prenom'];
    $mail=$_POST['mail'];
    $mdp=$_POST['mdp'];
    $verified='<script type="text/javascript" src="../javascriptfiles/signup.js">verif()</script>';
    if($verified){
        $redacteur=new Redacteur(0,$nom,$prenom,$mail,$mdp,$pseudo);
        $impl=new ImplRedacteurDAO();
        if($impl->getByMail($mail)!=NULL){
            echo"<script type='text/javascript'>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Cette mail existe déja!',
                });
                </script>";
        }else if($impl->getByPseudo($pseudo)!=NULL){
            echo"<script type='text/javascript'>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Ce pseudo existe déja!',
                });
                </script>";
        }else{
            $impl->create($redacteur);
            $_SESSION['pseudo']=$pseudo;
            header('Location: accueil.php');
        }
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
    <!--    JS-->
      <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="../javascriptfiles/includeHTML.js"></script>
      <script src="sweetalert2.all.min.js"></script>
      <script src="sweetalert2.min.js"></script>
      <link rel="stylesheet" href="sweetalert2.min.css">
  </head>
  <body>
  <?php
    include "header.php";
  ?>

    <div class="form-content">
      <form class="form" action="" method="post">
        <h2 class="form-title">Register</h2>
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
          <input type="email" id="mail" value="<?php echo $mail?>" name="mail" class="text-input">
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
          <input type="password" id="mdpConf" class="text-input">
            <i class="fas fa-check-circle"></i>
            <i class="fas fa-exclamation-circle"></i>
            <small></small>
        </div>
        <div>
          <input type="submit" id="register" value="Register" name="submit" class="btn" id="register">
        </div>
        <p>Or <a href="login.php">Sign In</a></p>
      </form>
    </div>
  </body>
  <script>includeHTML();</script>
  <script type="text/javascript" src="../javascriptfiles/signup.js"></script>
</html>
