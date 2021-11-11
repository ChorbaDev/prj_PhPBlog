<!doctype html>
<?php
    session_start();
include_once "/home/elloumi2u/Projet/path.php";
include_once ROOT_PATH."/controlleur/sujet/implSujetDAO.php";
include_once ROOT_PATH."/controlleur/theme/implThemeDAO.php";
include_once ROOT_PATH."/controlleur/redacteur/implRedacteurDAO.php";
include_once ROOT_PATH."/modele/sujet.php";
include_once "submitBlog.php";
$retour=0;
$implT=new ImplThemeDAO();
$implS=new ImplSujetDAO();
$implR=new ImplRedacteurDAO();
$topics=$implT->findAll();
if(isset($_GET['id']))
    $idPost=$_GET['id'];
$titre="";
if(isset($_GET['s'])){
    $implS->delete($idPost);
    $retour=1;
}
else if(isset($_GET['p'])){
    $implS->changePublie($idPost);
    $retour=1;
}
else{
    $errors=array();
    $image="";
    if(isset($_GET['idR']))
        $idredacteur=$_GET['idR'];
    else if(isset($_SESSION['pseudo']))
        $idredacteur=$implR->getByPseudo($_SESSION['pseudo'])->getId();
    $date = new DateTime('now', new DateTimeZone('Europe/Paris'));
    $currentDate=$date->format('d-m-Y H:i:s');
    if(isset($_GET['m'])){
        $titre="Modification d'un blog";
        $btnValue="Modifier";
        $post=$implS->getById($idPost);
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
                $extension=null;
                if($_FILES['image']['error'] == UPLOAD_ERR_OK){
                    $extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
                }
                if($extension=='jpg' || $extension=='jpeg' || $extension=='png' || $extension=='gif'){
                    $image =file_get_contents($_FILES['image']['tmp_name']);
                    $sujet = new Sujet(0, $idredacteur, $title, $text, $currentDate, $topic_id, $image, $publier);
                    $implS->update($idPost,$sujet);
                    $location='Location: '.BASE_URL."/vue/phpfiles/Resources/dashboard.php?b";
                    if(isset($_GET['idR']))
                        $location=$location."&id=".$idredacteur;
                    header($location);
                }
                else{
                    $image=null;
                    $sujet = new Sujet(0, $idredacteur, $title, $text, $currentDate, $topic_id, $image, $publier);
                    $implS->update($idPost,$sujet);
                    $location='Location: '.BASE_URL."/vue/phpfiles/Resources/dashboard.php?b";
                    if(isset($_GET['idR']))
                        $location=$location."&id=".$idredacteur;
                    header($location);
                }
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
            if (count($errors) == 0) {
                $extension=null;
                if($_FILES['image']['error'] == UPLOAD_ERR_OK){
                    $extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
                }
                if($extension=='jpg' || $extension=='jpeg' || $extension=='png' || $extension=='gif'){
                    $image =file_get_contents($_FILES['image']['tmp_name']);
                    $sujet = new Sujet(0, $idredacteur, $title, $text, $currentDate, $topic_id, $image, $publier);
                    $implS->create($sujet);
                    $location='Location: '.BASE_URL."/vue/phpfiles/Resources/dashboard.php?b";
                    if(isset($_GET['idR']))
                        $location=$location."&id=".$idredacteur;
                    header($location);
                }
                else{
                    $image=null;
                    $sujet = new Sujet(0, $idredacteur, $title, $text, $currentDate, $topic_id, $image, $publier);
                    $implS->create($sujet);
                    $location='Location: '.BASE_URL."/vue/phpfiles/Resources/dashboard.php?b";
                    if(isset($_GET['idR']))
                        $location=$location."&id=".$idredacteur;
                    header($location);
                }
            }
            }
    }

}
if($retour==1){
    $location='Location: '.BASE_URL."/vue/phpfiles/Resources/dashboard.php?b";
    if(isset($_GET['idR']))
        $location=$location."&id=".$_GET['idR'];
    header($location);
}
?>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $titre ?></title>
<link rel="stylesheet" href="../../cssfiles/guiBlog.css">
<!--    Font Awesome-->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
<!--    Google Fonts-->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
</head>
<body>
<?php
include ROOT_PATH."/vue/phpfiles/Resources/header.php";
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

<!-- Ckeditor -->
<script src="https://cdn.ckeditor.com/ckeditor5/12.2.0/classic/ckeditor.js"></script>
<!-- Custom Script -->
<script src="../../javascriptfiles/textAreaScript.js"></script>

</body>
</html>