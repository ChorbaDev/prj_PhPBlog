<?php
    session_start();
    include_once "../../controlleur/sujet/implSujetDAO.php";
    $retour=0;
    if(isset($_GET['id']))
    $id=$_GET['id'];
    $titre="";
    $impl=new ImplSujetDAO();
    if(isset($_GET['s'])){
        $impl->delete($id);
        $retour=1;
    }
    else if(isset($_GET['p'])){
        $impl->changePublie($id);
        $retour=1;
    }
    else if(isset($_GET['m'])){
        $titre="Edition d'un blog";
        $post=$impl->getById($id);
    }else{
        $titre="Ajout d'un blog";
    }
    if($retour==1) header("Location: ".$_SESSION['url']);
?>
<html>
<head><title><?php echo $titre ?></title></head>
<link rel="stylesheet" href="../cssfiles/guiRegisterLogin.css">
<link rel="stylesheet" href="../cssfiles/dashboard.css">
<!--    Font Awesome-->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
<!--    Google Fonts-->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

<body>
<?php
include "header.php";
?>
</body>
</html>