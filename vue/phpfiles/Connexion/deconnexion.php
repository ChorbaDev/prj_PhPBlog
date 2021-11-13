<style>
    .form-content{
        width: 50%;
        border-radius: 30px;
    }
    .btn{
        margin-top: 10px;
    }
</style>
<html>
<header>
    <title>Déconnexion</title>
    <link rel="stylesheet" href="../../cssfiles/guiStyle.css">
    <link rel="stylesheet" href="../../cssfiles/CommunEntre/formulaire.css">
    <?php
    include_once("/home/elloumi2u/Projet/path.php");
    session_start();
    if(isset($_POST['oui'])){
        $_SESSION[]=array();
        session_destroy();
        header('Location: '.BASE_URL.'/index.php');
    }
    else if(isset($_POST['non'])){
        header('Location: '.BASE_URL.'/index.php');
    }
    ?>
</header>
<body>
<div class="form-content">
    <form class="form" action="" method="post">
        <center>
            Vous voulez vraiment se déconnecter?
            <input class="btn" value="Oui" name="oui" type="submit">
            <input class="btn" value="Non" name="non" type="submit">
        </center>

    </form>
</div>

</body>
</html>
