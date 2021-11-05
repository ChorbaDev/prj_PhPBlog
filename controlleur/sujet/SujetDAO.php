<?php
include_once "DAO.php";
interface SujetDAO extends daof
{
    public function findAll();
    public function getById($id);
    public function getByIdRedacteur($id);
}

?>
