<?php
include_once "/home/elloumi2u/Projet/path.php";
include_once "ReponseDAO.php";
include_once ROOT_PATH . "/modele/connexion.php";
include_once ROOT_PATH . "/modele/reponse.php";

class implReponseDAO implements ReponseDAO
{
    private $conn;

    public function __construct()
    {
        $this->conn = new connexion();
    }

    public function create($object)
    {
        $create = $this->conn->connect()->prepare("insert into elloumi2u_blog.reponse(idsujet,idredacteur,textereponse) values(?,?,?)");
        $create->bindValue(1, $object->getIdSujet(), PDO::PARAM_INT);
        $create->bindValue(2, $object->getIdRedacteur(), PDO::PARAM_INT);
        $create->bindValue(3, $object->getTexteReponse());
        $create->execute();

    }

    public function update($id, $object)
    {
        $update = $this->conn->connect()->prepare("update elloumi2u_blog.reponse set textereponse=? where idreponse=?");
        $update->bindValue(1, $object->getTexteReponse());
        $update->bindValue(2, $id, PDO::PARAM_INT);
        $update->execute();

    }

    public function delete($id)
    {
        $delete = $this->conn->connect()->prepare("delete from elloumi2u_blog.reponse where idreponse=?");
        $delete->bindValue(1, $id, PDO::PARAM_INT);
        $delete->execute();
    }

    public function findAll()
    {
        $result = $this->conn->connect()->query("select * from elloumi2u_blog.reponse");
        $arr = [];
        foreach ($result as $row) {
            $reponse = new Reponse($row['idreponse'], $row['idsujet'], $row['idredacteur'], $row['daterep'], $row['textereponse']);
            array_push($arr, $reponse);
        }
        return $arr;
    }

    public function getByID($id)
    {
        $result = $this->conn->connect()->query("select * from elloumi2u_blog.reponse where idreponse=$id");
        $row = $result->fetch();
        $reponse = new Reponse($row['idreponse'], $row['idsujet'], $row['idredacteur'], $row['daterep'], $row['textereponse']);
        return $reponse;
    }

    public function getByIDSujet($id)
    {
        $result = $this->conn->connect()->query("select * from elloumi2u_blog.reponse where idsujet=$id");
        $row = $result->fetch();
        $reponse = new Reponse($row['idreponse'], $row['idsujet'], $row['idredacteur'], $row['daterep'], $row['textereponse']);
        return $reponse;
    }
}