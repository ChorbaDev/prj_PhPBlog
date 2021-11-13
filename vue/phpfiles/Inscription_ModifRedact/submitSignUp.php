<?php
    function verifier($pseudo,$nom,$prenom,$mail,$mdp,$confMdp,&$errors){
        verifPseudo($pseudo,$errors);
        verifNom($nom,$errors);
        verifPrenom($prenom,$errors);
        verifMail($mail,$errors);
        verifMdp($mdp,$errors);
        verifConfMdp($confMdp,$mdp,$errors);
    }

function verifMail($mail,&$errors)
{
   if(!(filter_var($mail, FILTER_VALIDATE_EMAIL) && !empty($mail)) )
       array_push($errors,"Vérifiez votre mail!");
}

function verifConfMdp($conf,$mdp,&$errors)
{
    if($conf!=$mdp || empty($conf)) array_push($errors,"Vérifiez le champ de vérification du mot de passe!");
}

function verifMdp($mdp,&$errors)
{
    if (!preg_match("/^(?=.*[0-9])(?=.*[!@#$%^&*:;])[a-zA-Z0-9!@#$%^&*:;]{6,16}$/", $mdp)){
        array_push($errors,"Votre mot de passe est faible:<br>Au moins 1 caractère spécial.<br>Au moins 1 chiffre.<br>Au moins un mot de passe de longueur 6.");
    }
}

function verifPrenom($prenom,&$errors)
{
    if (!preg_match("/^[a-zA-Z -çàéèù]+$/", $prenom) && !empty($prenom)){
        array_push($errors,"Vérifiez votre prénom!");
    }
}

function verifNom($nom,&$errors)
{
    if (!preg_match("/^[a-zA-Z -çàéèù]+$/", $nom) && !empty($nom)){
        array_push($errors,"Vérifiez votre nom!");
    }
}

function verifPseudo($pseudo,&$errors)
{
    if( empty($pseudo)) array_push($errors,'Le champ pseudo est obligatoire!');
}

?>