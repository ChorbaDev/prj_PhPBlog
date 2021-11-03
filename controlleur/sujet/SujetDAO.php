<?php
include_once "/DAO.php";
interface SujetDAO extends DAO
{
    public function findAll();
    public function getById($id);
}

?>
