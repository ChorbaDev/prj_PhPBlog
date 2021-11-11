<?php
include_once "/home/elloumi2u/Projet/path.php";
include_once "SujetDAO.php";
include_once ROOT_PATH."/modele/connexion.php";
include_once ROOT_PATH."/modele/sujet.php";

class implSujetDAO implements SujetDAO{
    private $conn;
    public function __construct(){
        $this->conn=new connexion();
    }
    public function create($object)
    {
        $date=date('Y-m-d H:i:s', strtotime($object->getDateSujet()));
        $create=$this->conn->connect()->prepare("insert into elloumi2u_blog.sujet(idredacteur,titresujet,textesujet,datesujet,theme,image,publie) values(?,?,?,?,?,?,?)");
        $create->bindValue(1,$object->getIdRedacteur(),PDO::PARAM_INT);
        $create->bindValue(2,$object->getTitreSujet());
        $create->bindValue(3,$object->getTexteSujet());
        $create->bindValue(4,$date);
        $create->bindValue(5,$object->getTheme());
        $create->bindValue(6,$object->getImage());
        $create->bindValue(7,$object->getPublie(),PDO::PARAM_BOOL);
        $create->execute();
    }

    public function update($id, $object)
    {
        $date=date('Y-m-d H:i:s', strtotime($object->getDateSujet()));
        $update=$this->conn->connect()->prepare("update elloumi2u_blog.sujet set idredacteur=?,titresujet=?,textesujet=?,datesujet=?,theme=?,image=?,publie=? where idsujet=?");
        $update->bindValue(1,$object->getIdRedacteur(),PDO::PARAM_INT);
        $update->bindValue(2,$object->getTitreSujet(),PDO::PARAM_STR);
        $update->bindValue(3,$object->getTexteSujet(),PDO::PARAM_STR);
        $update->bindValue(4,$date,PDO::PARAM_STR);
        $update->bindValue(5,$object->getTheme(),PDO::PARAM_STR);
        if(($object->getImage())!=null)
            $update->bindValue(6,$object->getImage(),PDO::PARAM_STR);
        else
            $update->bindValue(6,$this->getById($id)->getImage(),PDO::PARAM_STR);
        $update->bindValue(7,$object->getPublie(),PDO::PARAM_BOOL);
        $update->bindValue(8,$id,PDO::PARAM_INT);
        $update->execute();
    }

    public function delete($id)
    {
        $delete = $this->conn->connect()->prepare("delete from elloumi2u_blog.sujet where idsujet=?");
        $delete->bindValue(1, $id, PDO::PARAM_INT);
        $delete->execute();
    }

    public function findAll()
    {
        $result = $this->conn->connect()->query("select * from elloumi2u_blog.sujet");
        $arr = [];
        foreach ($result as $row) {
            $sujet = new Sujet($row['idsujet'], $row['idredacteur'], $row['titresujet'], $row['textesujet'], $row['datesujet'], $row['theme'], $row['image'], $row['publie']);
            array_push($arr, $sujet);
        }
        return $arr;
    }

    public function getById($id)
    {
        $result = $this->conn->connect()->query("select * from elloumi2u_blog.sujet where idsujet=$id");
        $row = $result->fetch();
        $sujet = new Sujet($id, $row['idredacteur'], $row['titresujet'], $row['textesujet'], $row['datesujet'], $row['theme'], $row['image'], $row['publie']);
        return $sujet;
    }

    public function getByIdRedacteur($id)
    {
        $arrRedacteur = [];
        $arr = $this->findAll();
        foreach ($arr as $sujet) {
            if ($sujet->getIdRedacteur() == $id)
                array_push($arrRedacteur, $sujet);
        }
        return $arrRedacteur;
    }

    public function changePublie($id)
    {
        $update = $this->conn->connect()->prepare("update elloumi2u_blog.sujet set publie=(publie-1)* -1 where idsujet=?");
        $update->bindValue(1, $id, PDO::PARAM_INT);
        $update->execute();
    }
    public function rechercher($str)
    {
        $arrRedacteur = [];
        $arr = $this->findAll();
        foreach ($arr as $sujet) {
            if ($sujet instanceof sujet &&  $sujet->getPublie()==1 && (strstr($sujet->getTexteSujet(),$str) ||strstr($sujet->getTitreSujet(),$str)))
                array_push($arrRedacteur, $sujet);
        }
        return $arrRedacteur;
    }
}
?>