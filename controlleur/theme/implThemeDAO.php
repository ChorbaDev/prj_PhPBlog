<?php
include_once "ThemeDAO.php";
include_once "../../modele/connexion.php";
class ImplThemeDAO extends connexion implements ThemeDAO{
  public function create($object){}
  public function update($object){}
  public function delete($object){}
  public function getByID($id){}
  public function findAll(){
    $result=$this->connect()->query("select * from theme");
    foreach($result as $row)
      echo $row["theme"];
  }
}
?>
<?php
$x=new ImplThemeDAO();
$x->findAll();
?>