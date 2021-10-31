<?php

$host='mysql:host=devbdd.iutmetz.univ-lorraine.fr';
$port='port=3306';
/*$user='ghoniem1u_appli';
$pw='bonjour';
$db='ghoniem1u_bdblog';*/
$user='elloumi2u_appli';
$pw='32024561';
$db='elloumi2u_blog';
try{
    $cnx=new PDO($host.';'.$port.';'.$db,$user,$pw);
}
catch (PDOException $exception)
{
    die($exception->getMessage());
}
