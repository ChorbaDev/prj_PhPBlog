<?php
include_once 'DAO.php';
interface RedacteurDAO extends DAO
{
  public function findAll();
  public function getByID($id);
  public function getByMail($mail);
  public function getByPseudo($pseudo);
}

?>
