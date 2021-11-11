<?php
include_once "/home/elloumi2u/Projet/path.php";
include_once ROOT_PATH."/controlleur/DAO.php";

interface ReponseDAO extends dao
{
    public function findAll();
    public function getByID($id);
    public function getByIDSujet($id);
}