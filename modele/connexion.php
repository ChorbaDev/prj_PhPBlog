<?php

class connexion{
     private $host='mysql:host=devbdd.iutmetz.univ-lorraine.fr';
     private $port='port=3306';
     private $user='elloumi2u_appli';
     private $pw='32024561';
     private $db='elloumi2u_blog';
     function connect(){
         return new PDO($this->host.';'.$this->port.';'.$this->db,$this->user,$this->pw);
     }
}
/*$user='ghoniem1u_appli';
$pw='bonjour';
$db='ghoniem1u_bdblog';
$db='elloumi2u_blog';
try{
$cnx=new PDO($host.';'.$port.';'.$db,$user,$pw);
echo "nice";
}
catch (PDOException $exception)
{
die($exception->getMessage());
}*/

?>
