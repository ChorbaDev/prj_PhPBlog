<?php
function verifierChampsPost(&$errors,$title,$text,$topic){
    if(empty($title)) array_push($errors,"Le champ titre est vide");
    if(empty($text)) array_push($errors,"Le champ text est vide");
    if(empty($topic)) array_push($errors,"Il faut choisir un thème");
}
?>