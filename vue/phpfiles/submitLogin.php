<?php
function verifier($input,$mdp,&$errors){
    verifMail($input,$errors);
    verifMdp($mdp,$errors) ;
}

function verifMdp($mdp,$errors){
    if(empty($mdp)) array_push($errors,"Entrez votre mot de passe");
}
function verifMail($input,$errors){
    if(empty($input)) array_push($errors,"Entez votre mail ou pseudo");
}
?>