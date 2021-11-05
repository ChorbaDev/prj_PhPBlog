<?php
    function verifier($pseudo,$nom,$prenom,$mail,$mdp,$confMdp){
        return verifPseudo($pseudo)&& verifNom($nom) && verifPrenom($prenom) && verifMail($mail) && verifMdp($mdp)  && verifConfMdp($confMdp,$mdp);
    }

function verifMail($mail)
{
   return filter_var($mail, FILTER_VALIDATE_EMAIL) && !empty($mail);
}

function verifConfMdp($conf,$mdp)
{
    return $conf==$mdp;
}

function verifMdp($mdp)
{
    return (preg_match("/^(?=.*[0-9])(?=.*[!@#$%^&*:;])[a-zA-Z0-9!@#$%^&*:;]{6,16}$/", $mdp));
}

function verifPrenom($prenom)
{
    return (preg_match("/^[a-zA-Z -çàéèù]+$/", $prenom) && !empty($prenom));
}

function verifNom($nom)
{
    return (preg_match("/^[a-zA-Z -çàéèù]+$/", $nom) && !empty($nom));
}

function verifPseudo($pseudo)
{
    return !empty($pseudo);
}

?>