<?php
include_once 'DAO.php';
interface RedacteurDAO extends dao
{
  public function findAll();
  public function getByID($id);
  public function getByMail($mail);
  public function getByPseudo($pseudo);
  public function redacteurExiste($mail,$mdp);
  public function isAdmin($pseudo);
  public function changeAdmin($id);
}

?>
