<!doctype html>
<?php
    session_start();
    include_once "../../controlleur/sujet/implSujetDAO.php";
    include_once "../../controlleur/theme/implThemeDAO.php";
    include_once "../../controlleur/redacteur/implRedacteurDAO.php";
    include_once "../../modele/sujet.php";
    require_once "submitBlog.php";
$retour=0;
$implT=new ImplThemeDAO();
$implS=new ImplSujetDAO();
$implR=new ImplRedacteurDAO();
$topics=$implT->findAll();
if(isset($_GET['id']))
    $id=$_GET['id'];
$titre="";
if(isset($_GET['s'])){
    $implS->delete($id);
    $retour=1;
}
else if(isset($_GET['p'])){
    $implS->changePublie($id);
    $retour=1;
}
else{
    $errors=array();
    $image="";
    if(isset($_SESSION['pseudo']))
        $idredacteur=$implR->getByPseudo($_SESSION['pseudo'])->getId();
    $date = new DateTime('now', new DateTimeZone('Europe/Paris'));
    $currentDate=$date->format('d-m-Y H:i:s');
    if(isset($_GET['m'])){
        $titre="Modification d'un blog";
        $btnValue="Modifier";
        $post=$implS->getById($id);
        $title=$post->getTitreSujet();
        $text=$post->getTexteSujet();
        $publier=$post->getPublie();
        $topic_id=$post->getTheme();
        if(isset($_POST['btn-post'])) {
            $title=$_POST['title'];
            $text=$_POST['body'];
            $topic_id=$_POST['topic_id'];
            $publier=isset($_POST['published']);
            verifierChampsPost($errors, $title, $text, $topic_id);
            if (count($errors) == 0) {
                unset($_POST["btn-post"]);
                if(isset($_POST['image']))
                $image =file_get_contents($_FILES['image']['tmp_name']);
                $sujet = new Sujet(0, $idredacteur, $title, $text, $currentDate, $topic_id, $image, $publier);
                $implS->update($id, $sujet);
                header('Location: dashboard.php');
            }
        }
    }else{
        $titre="Ajout d'un blog";
        $btnValue="Ajouter";
        $title='';
        $text='';
        $publier=null;
        $topic_id=null;
        if(isset($_POST['btn-post'])){
            $title=$_POST['title'];
            $text=$_POST['body'];
            $topic_id=$_POST['topic_id'];
            $publier=isset($_POST['published']);
            verifierChampsPost($errors,$title,$text,$topic_id);
            if(count($errors)==0){
                unset($_POST["btn-post"]);
                if(isset($_POST['image']))
                $image =file_get_contents($_FILES['image']['tmp_name']);
                $sujet=new Sujet(0,$idredacteur,$title,$text,$currentDate,$topic_id,$image,$publier);
                $implS->create($sujet);
                header('Location: dashboard.php');
            }
        }
    }

}
if($retour==1)
    header("Location: ".$_SESSION['url']);
?>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $titre ?></title>
<link rel="stylesheet" href="../cssfiles/guiEditBlog.css">
<!--    Font Awesome-->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
<!--    Google Fonts-->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
</head>
<body>
<?php
include "header.php";
?>
<?php if(count($errors) > 0):?>
<div class="msg error">
    <?php foreach ($errors as $error): ?>
    <li><?php echo $error ?></li>
    <?php endforeach;?>
</div>
<?php endif; ?>
        <div class="form-content">
            <h2 class="form-title"><?php echo $titre ?></h2>

            <form action="" method="post" enctype="multipart/form-data">
                <div>
                    <label>Title</label>
                    <input type="text" name="title" value="<?php echo $title ?>" class="text-input">
                </div>
                <div class="form-control">
                    <label>Body</label>
                    <textarea name="body" id="body"><?php echo $text ?></textarea>
                </div>
                <div class="form-control">
                    <label>Image</label>
                    <input type="file" name="image" class="text-input" accept="image/x-png,image/gif,image/jpeg">
                </div>
                <div class="form-control">
                    <label>Topic</label>
                    <select name="topic_id" class="text-input">
                        <option value=""></option>
                        <?php foreach ($topics as $topic): ?>

                                <option <?php if (!empty($topic_id) && $topic_id == $topic) echo "selected" ?>
                                        value="<?php echo $topic ?>"><?php echo $topic ?></option>
                        <?php endforeach; ?>

                    </select>
                </div>
                <div class="form-control">
                        <label>
                            <input type="checkbox" name="published" <?php if(!empty($publier)) echo "checked"?>>
                            Publish
                        </label>
                </div>
                <div>
                    <button type="submit" name="btn-post" class="btn btn-big"><?php echo $btnValue ?></button>
                </div>
            </form>

        </div>

<!-- JQuery -->
<!--<script-->
<!--        src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
<!-- Ckeditor -->
<script
        src="https://cdn.ckeditor.com/ckeditor5/12.2.0/classic/ckeditor.js"></script>
<!-- Custom Script -->
<script src="../javascriptfiles/textAreaScript.js"></script>

</body>
</html>