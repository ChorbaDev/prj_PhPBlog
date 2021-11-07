<?php
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
    if(isset($_SESSION['pseudo']))
        $idredacteur=$implR->getByPseudo($_SESSION['pseudo'])->getId();
    $date = new DateTime('now', new DateTimeZone('Europe/Bucharest'));
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
                $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
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
                $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
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