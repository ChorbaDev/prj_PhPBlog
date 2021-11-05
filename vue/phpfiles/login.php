<?php
session_start();
include_once "../../controlleur/redacteur/implRedacteurDAO.php";
require_once "submitLogin.php";
$mail='';
$mdp='';
$err='';
if(isset($_POST['Connexion'])){
    $mail=$_POST['mail'];
    $mdp=$_POST['mdp'];
    $verified=verifier($mail,$mdp);
    if($verified){
        $impl=new ImplRedacteurDAO();
        $ok=$impl->redacteurExiste($mail,$mdp);
        echo "<script type='text/javascript'>
                $ok;
            </script>";
        if($impl->redacteurExiste($mail,$mdp)){
            $_SESSION['pseudo']=$impl->getByMail($mail)->getPseudo();
            header('Location: accueil.php');
        }
        else {
            echo '<script type="text/javascript">
            alert("Ce compte n\'existe pas!");
            </script>';
            $err=$err."Ce compte n'existe pas!<br>";
        }
    }else{
        if(!verifMdp($mdp)) $err=$err."Le mot de passe ne doit pas etre vide<br>";
        else $err=$err."Vérifier votre mail<br>";
    }

}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Se Connecter</title>
    <!--    Font Awesome-->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <!--    Google Fonts-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
        <!--    CSS-->
        <link rel="stylesheet" href="../cssfiles/guiRegisterLogin.css">
        <!--    JS-->
        <script type="text/javascript" src="../javascriptfiles/includeHTML.js"></script>
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
      <form action="login.php" method="post">
          <h2 class="form-title">Se Connecter</h2>
          <div class="form-control">
              <label>Adresse mail</label>
              <input type="email" name="mail" id="mail" value=" <?php echo $mail; ?>" class="text-input">
              <i class="fas fa-check-circle"></i>
              <i class="fas fa-exclamation-circle"></i>
              <small></small>
          </div>
          <div class="form-control pass">
              <label>Mot de passe</label>
              <input type="password" name="mdp" id="mdp" class="text-input">
              <i class="fas fa-check-circle"></i>
              <i class="fas fa-exclamation-circle"></i>
              <small></small>
          </div>
          <div>
              <input type="submit" value="Connexion" name="Connexion" id="Connexion" class="btn">
          </div>
          <p>Vous n'avez pas un compte? <a href="signup.php">Créer un compte</a></p>
      </form>
  </div>
  </body>
  <script type="text/javascript" src="../javascriptfiles/login.js"></script>
</html>
