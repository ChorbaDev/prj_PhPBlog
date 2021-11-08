<?php
function verifier($input,$mdp,&$errors){
    verifMail($input);
    verifMdp($mdp) ;
}

function verifMdp($mdp){
    if(empty($mdp)) array_push($errors,"Entrez votre mot de passe");
}
function verifMail($input){
    if(empty($input)) array_push($errors,"Entez votre mail ou pseudo");
}
?>