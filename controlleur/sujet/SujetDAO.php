<?php
include_once "/home/elloumi2u/Projet/path.php";
include_once ROOT_PATH."/controlleur/DAO.php";
interface SujetDAO extends dao
{
    public function findAll();
    public function getById($id);
    public function getByIdRedacteur($id);
    public function changePublie($id);
    public function rechercher($str);
    public function getByTheme($str);
}

?>
