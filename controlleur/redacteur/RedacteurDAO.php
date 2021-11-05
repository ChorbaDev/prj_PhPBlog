<?php
include_once 'DAO.php';
interface RedacteurDAO extends daof
{
  public function findAll();
  public function getByID($id);
  public function getByMail($mail);
  public function getByPseudo($pseudo);
  public function redacteurExiste($mail,$mdp);
}

?>
