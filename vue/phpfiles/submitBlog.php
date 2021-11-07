<?php
function verifierChampsPost(&$errors,$title,$text,$topic){
    if(empty($title)) array_push($errors,"Titre est vide");
    if(empty($text)) array_push($errors,"Text est vide");
    if(empty($topic)) array_push($errors,"Il faut choisir un théme");
}
?>