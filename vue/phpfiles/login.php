<?php
session_start();
include_once "../../controlleur/redacteur/implRedacteurDAO.php";
require_once "submitLogin.php";
$mail='';
$mdp='';
$ok='';
$errors=array();
if(isset($_POST['Connexion'])){
    $mail=$_POST['mail'];
    $mdp=$_POST['mdp'];
    verifier($mail,$mdp,$errors);
    if(sizeof($errors)==0){
        $impl=new ImplRedacteurDAO();
        if($impl->redacteurExiste($mail,$mdp)){
            if($impl->getByMail($mail))
                $_SESSION['pseudo']=$impl->getByMail($mail)->getPseudo();
            else
                $_SESSION['pseudo']=$mail;
            header('Location: accueil.php');
        }
        else {
            array_push($errors,"Ce compte n'existe pas!");
        }
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
        <link rel="stylesheet" href="../cssfiles/guiFormulaireRedacteur.css">
        <!--    JS-->
        <script type="text/javascript" src="../javascriptfiles/includeHTML.js"></script>
  </head>

  <body>
  <?php
    include "header.php";
  ?>

  <?php if(!empty($ok)):?>
      <div class="msg succee">
          <li><?php echo $ok ?></li>
      </div>
  <?php endif; ?>

  <?php if(count($errors) > 0):?>
      <div class="msg error">
          <?php foreach ($errors as $error): ?>
              <li><?php echo $error ?></li>
          <?php endforeach;?>
      </div>
  <?php endif; ?>

  <div class="form-content">
      <form action="login.php" method="post">
          <h2 class="form-title">Se Connecter</h2>
          <div class="form-control">
              <label>Adresse mail ou Pseudo</label>
              <input type="text" name="mail" id="mail" value="<?php echo $mail; ?>" class="text-input">
          </div>
          <div class="form-control pass">
              <label>Mot de passe</label>
              <input type="password" name="mdp" id="mdp" class="text-input">
          </div>
          <div>
              <input type="submit" value="Connexion" name="Connexion" id="Connexion" class="btn">
          </div>
          <p>Vous n'avez pas un compte? <a href="formulaireRedacteur.php?c">Créer un compte</a></p>
      </form>
  </div>
  </body>
</html>
