<?php
include_once "RedacteurDAO.php";
include_once "../../modele/connexion.php";
include_once "../../modele/redacteur.php";
class ImplRedacteurDAO implements RedacteurDAO{
  private $conn;
  public function __construct(){
    $this->conn=new connexion();
  }
  public function create($object){
    $create=$this->conn->connect()->prepare("insert into elloumi2u_blog.redacteur(nom,prenom,adressemail,motdepasse,pseudo) values(?,?,?,?,?)");
    $create->bindValue(1,$object->getNom(),PDO::PARAM_STR);
    $create->bindValue(2,$object->getPrenom(),PDO::PARAM_STR);
    $create->bindValue(3,$object->getMail(),PDO::PARAM_STR);
    $create->bindValue(4,$object->getMdp(),PDO::PARAM_STR);
    $create->bindValue(5,$object->getPseudo(),PDO::PARAM_STR);
    $create->execute();
  }
  public function update($id,$par){
    $update=$this->conn->connect()->prepare("update elloumi2u_blog.redacteur set nom=?, prenom=?, adressemail=?, motdepasse=?, pseudo=? where idredacteur=?");
    $update->bindValue(1,$par->getNom(),PDO::PARAM_STR);
    $update->bindValue(2,$par->getPrenom(),PDO::PARAM_STR);
    $update->bindValue(3,$par->getMail(),PDO::PARAM_STR);
    $update->bindValue(4,$par->getMdp(),PDO::PARAM_STR);
    $update->bindValue(5,$par->getPseudo(),PDO::PARAM_STR);
    $update->bindValue(6,$id,PDO::PARAM_INT);
    $update->execute();
  }
  public function getByMail($mail){
    $result=$this->conn->connect()->query("select * from elloumi2u_blog.redacteur where adressemail='$mail'");
    $row=$result->fetch();
    if(!$row) return null;
    $redacteur=new Redacteur($row['idredacteur'],$row['nom'],$row['prenom'],$mail,$row['motdepasse'],$row["pseudo"]);
    return $redacteur;
  }

  public function getByPseudo($pseudo){
    $result=$this->conn->connect()->query("select * from elloumi2u_blog.redacteur where pseudo='$pseudo'");
    $row=$result->fetch();
    if(!$row) return null;
    $redacteur=new Redacteur($row['idredacteur'],$row['nom'],$row['prenom'],$row['adressemail'],$row['motdepasse'],$pseudo);
    return $redacteur;
  }
  public function delete($id){
    $delete=$this->conn->connect()->prepare("delete from elloumi2u_blog.redacteur where idredacteur=?");
    $delete->bindValue(1,$id,PDO::PARAM_INT);
    $delete->execute();
  }
  public function getByID($id){
  $result=$this->conn->connect()->query("select * from elloumi2u_blog.redacteur where idredacteur=$id");
  $row=$result->fetch();
    if(!$row) return null;
  $redacteur=new Redacteur($id,$row['nom'],$row['prenom'],$row['adressemail'],$row['motdepasse'],$row["pseudo"]);
  return $redacteur;
  }
  public function findAll(){
    $result=$this->conn->connect()->query("select * from elloumi2u_blog.redacteur");
    $arr=[];
    foreach ($result as $row){
      $redact=new Redacteur($row['idredacteur'],$row['nom'],$row['prenom'],$row['adressemail'],$row['motdepasse'],$row["pseudo"]);
      array_push($arr,$redact);
    }
    return $arr;
  }
  public function redacteurExiste($input,$mdp){
    $result=$this->conn->connect()->query("select * from elloumi2u_blog.redacteur where (adressemail='$input' or pseudo='$input') and (motdepasse='$mdp')");
    $row=$result->fetch();
    if($row) return true;
    return false;
  }

  public function changeAdmin($id)
  {
    $update = $this->conn->connect()->prepare("update elloumi2u_blog.redacteur set admin=(admin-1)* -1 where idredacteur=?");
    $update->bindValue(1, $id, PDO::PARAM_INT);
    $update->execute();
  }

  public function isAdmin($pseudo)
  {
    $result=$this->conn->connect()->query("select * from elloumi2u_blog.redacteur where pseudo='$pseudo'");
    $row=$result->fetch();
    if($row['admin']!=null) return true;
    return false;
  }
}
?>
