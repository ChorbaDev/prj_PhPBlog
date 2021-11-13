<?php
session_start();
include_once "/home/elloumi2u/Projet/path.php";
include_once ROOT_PATH."/controlleur/redacteur/implRedacteurDAO.php";
include_once ROOT_PATH."/modele/redacteur.php";
require_once "submitSignUp.php";
$pseudo='';
$nom='';
$prenom='';
$mail='';
$mdp='';
$err='';
$confMdp='';
$ok='';
$errors=array();
$impl=new ImplRedacteurDAO();
if(isset($_GET['ad'])){
    if(isset($_GET['id']))
        $id=$_GET['id'];
    $impl->changeAdmin($id);
    header('Location: '.BASE_URL.'/vue/phpfiles/Resources/dashboard.php?r');
}else if(isset($_GET['s'])){
    $impl->delete($_GET['id']);
    header('Location: '.BASE_URL.'/vue/phpfiles/Resources/dashboard.php?r');
}
else if(isset($_GET['p'])){
    $titrePage="Paramètre";
    $btnValue="Modifier";
    $impl=new ImplRedacteurDAO();
    if(isset($_GET['id'])){
        $_SESSION['url']=BASE_URL."/vue/phpfiles/Resources/dashboard.php?r";
        $redacteur=$impl->getByID($_GET['id']);
    }
    else{
        $_SESSION['url']=BASE_URL."/index.php";
        $redacteur=$impl->getByPseudo($_SESSION['pseudo']);
    }
    $pseudo=$redacteur->getPseudo();
    $nom=$redacteur->getNom();
    $prenom=$redacteur->getPrenom();
    $mail=$redacteur->getMail();
    $mdp='';
    $err='';
    $confMdp='';
    if(isset($_POST["btn"])){
        $pseudo=$_POST['pseudo'];
        $mail=$_POST['mail'];
        $nom=$_POST['nom'];
        $prenom=$_POST['prenom'];
        $mdp=$_POST['mdp'];
        $confMdp=$_POST['mdpC'];
        verifier($pseudo,$nom,$prenom,$mail,$mdp,$confMdp,$errors);
        if(sizeof($errors)==0){
            $redacteur2=new Redacteur(0,$nom,$prenom,$mail,$mdp,$pseudo);
            $impl=new ImplRedacteurDAO();
            if($redacteur->getMail()!=$mail  || $redacteur->getPseudo()!=$pseudo){
                if($redacteur->getMail()!=$mail && $impl->getByMail($mail)!=NULL) {
                    array_push($errors,'Ce mail existe déjà!');
                }else if($redacteur->getPseudo()!=$pseudo && $impl->getByPseudo($pseudo)!=NULL){
                    array_push($errors,'Ce pseudo existe déjà!');
                }
                else{
                    $impl->update($redacteur->getId(),$redacteur2);
                    if(!isset($_GET['id']))
                    $_SESSION['pseudo']=$pseudo;
                    $ok="Modification avec succès";
                    header('Refresh: 2; URL='.$_SESSION['url']);
                }
            }
            else{
                $impl->update($redacteur->getId(),$redacteur2);
                $ok="Modification avec succès";
                if(!isset($_GET['id']))
                $_SESSION['pseudo']=$pseudo;
                header('Refresh: 2; URL='.$_SESSION['url']);
            }
        }
    }
}
else{
    $titrePage="S'inscrire";
    $btnValue="Créer";
if(isset($_POST["btn"])){
    $pseudo=$_POST['pseudo'];
    $mail=$_POST['mail'];
    $nom=$_POST['nom'];
    $prenom=$_POST['prenom'];
    $mdp=$_POST['mdp'];
    $confMdp=$_POST['mdpC'];
    verifier($pseudo,$nom,$prenom,$mail,$mdp,$confMdp,$errors);
    if(sizeof($errors)==0){
        $redacteur=new Redacteur(0,$nom,$prenom,$mail,$mdp,$pseudo);
        $impl=new ImplRedacteurDAO();
            if($impl->getByMail($mail)!=NULL) {
                array_push($errors,'Cette mail existe déjà!');
            }else if($impl->getByPseudo($pseudo)!=NULL){
                array_push($errors,'Ce pseudo existe déjà!');
            }
            else{
                $impl->create($redacteur);
                $location=BASE_URL.'/index.php';
                if(isset($_GET['admin'])){
                    $location=BASE_URL."/vue/phpfiles/Resources/dashboard.php?r";
                }else $_SESSION['pseudo']=$pseudo;
                $ok="Création avec succès";
                header('Refresh: 2; URL='.$location);
            }
    }
}
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title><?php echo $titrePage ?></title>
    <!--    Font Awesome-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <!--    Google Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <!--    CSS-->
    <link rel="stylesheet" href="../../cssfiles/guiFormulaireRedacteur.css">
</head>
<body>
<?php
include ROOT_PATH."/vue/phpfiles/Resources/header.php";
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
    <form class="form" action="" method="post">
        <h2 class="form-title"><?php echo $titrePage ?></h2>
        <div class="form-control">
            <label>Pseudo</label>
            <input type="text" id="pseudo" name="pseudo" value="<?php echo $pseudo?>" class="text-input">
        </div>
        <div class="form-control">
            <label>Nom</label>
            <input type="text" id="nom" name="nom" value="<?php echo $nom?>" class="text-input">
        </div>
        <span id="pr"></span>
        <div class="form-control">
            <label>Prénom</label>
            <input type="text" id="prenom" name="prenom" value="<?php echo $prenom?>"class="text-input">
        </div>
        <div class="form-control">
            <label>Adresse mail</label>
            <input type="email" id="mail" value="<?php echo $mail?>" name="mail" class="text-input">
        </div>
        <div class="form-control pass">
            <label>Mot de passe</label>
            <input type="password" id="mdp" name="mdp" class="text-input">
        </div>
        <div class="form-control">
            <label>Confirmation du Mot de passe</label>
            <input type="password" id="mdpConf" name="mdpC" class="text-input">
        </div>
        <div>
            <input type="submit" id="btn" value="<?php echo $btnValue ?>" name="btn" class="btn" >
        </div>
        <?php if(!isset($_GET['p']) && !isset($_GET['admin'])): ?>
        <p>Ou <a href="../Connexion/Login/login.php">Se connecter</a></p>
        <?php endif; ?>
    </form>
</div>
</body>
</html>
