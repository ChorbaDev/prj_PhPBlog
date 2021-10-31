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
      <header include-html="header.php"></header>
  </body>
  <div class="form-content">
    <form action="login.php" method="post">
      <h2 class="form-title">Se Connecter</h2>
      <div>
        <label>Adresse mail</label>
        <input type="email" name="mail" class="text-input">
      </div>
      <div>
        <label>Mot de passe</label>
        <input type="password" name="mdp" class="text-input">
      </div>
      <div>
        <button type="submit" name="Connexion" class="btn">Register</button>
      </div>
      <p>Vous n'avez pas un compte? <a href="signup.php">Créer un compte</a></p>
    </form>
  </div>
  <script>
      includeHTML();
  </script>
</html>
