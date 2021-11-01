<?php

class connexion {
     protected static $pdo;
     public function __construct(){}

     public function connect(){
          $host='mysql:host=devbdd.iutmetz.univ-lorraine.fr';
          $port='port=3306';
          $user='elloumi2u_appli';
          $pw='32024561';
          $db='elloumi2u_blog';
          try{
               self::$pdo =new PDO($host.';'.$port.';'.$db,$user,$pw);
               self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
               return self::$pdo;
          }catch(PDOException $ex){
               echo $ex->getMessage();
          }
          return false;
     }
     public function getConnection(){
          return self::$pdo;
     }
}
?>
