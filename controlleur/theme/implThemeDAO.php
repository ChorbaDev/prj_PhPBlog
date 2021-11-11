<?php
include_once "/home/elloumi2u/Projet/path.php";
include_once "ThemeDAO.php";
include_once ROOT_PATH."/modele/connexion.php";
class ImplThemeDAO implements ThemeDAO{
  private $conn;
  public function __construct(){
    $this->conn=new connexion();
  }
  public function create($object){
    $create=$this->conn->connect()->prepare("insert into elloumi2u_blog.theme values(?)");
    $create->bindValue(1,$object,PDO::PARAM_STR);
    $create->execute();
  }
  public function update($aRemplacer,$par){
    $update=$this->conn->connect()->prepare("update elloumi2u_blog.theme set theme=? where theme=?");
    $update->bindValue(1,$par,PDO::PARAM_STR);
    $update->bindValue(2,$aRemplacer,PDO::PARAM_STR);
    $update->execute();
  }
  public function delete($object){
    $delete=$this->conn->connect()->prepare("delete from elloumi2u_blog.theme where theme=?");
    $delete->bindValue(1,$object,PDO::PARAM_STR);
    $delete->execute();
  }

  public function findAll(){
    $result=$this->conn->connect()->query("select * from elloumi2u_blog.theme");
    $arr=[];
    foreach ($result as $row) array_push($arr,$row['theme']);
    return $arr;
  }

    public function themeExiste($th){
        $arr=$this->findAll();
        foreach($arr as $theme){
            if($theme==$th)
                return true;
        }
        return false;
    }
}
?>