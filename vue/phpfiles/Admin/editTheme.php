<?php
session_start();
include_once "/home/elloumi2u/Projet/path.php";
include_once ROOT_PATH."/controlleur/theme/implThemeDAO.php";
$input='';
$mdp='';
$ok='';
$retour=0;
$errors=array();
$lib='';
$titre='';
$btnValue='';
$implT=new ImplThemeDAO();
if(isset($_GET['s'])){
    $implT->delete($_GET['th']);
    $retour=1;
}
else if(isset($_GET['m'])){
    $titre="Modification d'un théme";
    $btnValue="Modifier";
    $lib=$_GET['th'];
    $ancLib=$lib;
    if(isset($_POST['submit'])){
        $lib=$_POST['lib'];
        if(empty($lib)) array_push($errors,"Saisissez la libelle");
        else if($implT->themeExiste($lib)) array_push($errors,"Ce théme existe déja");
        else{
            $implT->update($ancLib,$lib);
            $ok="Modification avec succées!";
            header('Refresh: 2; URL= '.BASE_URL.'/vue/phpfiles/Resources/dashboard.php?t');
        }
    }
}
else{
    $titre="Ajout d'un théme";
    $btnValue="Ajouter";
    if(isset($_POST['submit'])){
        $lib=$_POST['lib'];
        if(empty($lib)) array_push($errors,"Saisissez la libelle");
        else if($implT->themeExiste($lib)) array_push($errors,"Ce théme existe déja");
        else{
            $implT->create($lib);
            $ok="Ajout avec succées!";
            header('Refresh: 2; URL= '.BASE_URL.'/vue/phpfiles/Resources/dashboard.php?t');
        }
    }
}
if($retour==1){
    $location='Location: '.BASE_URL."/vue/phpfiles/Resources/dashboard.php?t";
    header($location);
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title><?php echo $titre ?></title>
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
    <form action="" method="post">
        <h2 class="form-title"><?php echo $titre ?></h2>
        <div class="form-control">
            <label>Libelle</label>
            <input type="text" name="lib" id="mail" value="<?php echo $lib; ?>" class="text-input">
        </div>
        <div>
            <input type="submit" value="<?php echo $btnValue; ?>" name="submit" id="Connexion" class="btn">
        </div>
    </form>
</div>
</body>
</html>
