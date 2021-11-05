<?php
function verifier($mail,$mdp){
    return   verifMail($mail) && verifMdp($mdp) ;
}

function verifMdp($mdp)
{
return (!empty($mdp));
}
function verifMail($mail)
{
return filter_var($mail, FILTER_VALIDATE_EMAIL) && !empty($mail);
}
?>