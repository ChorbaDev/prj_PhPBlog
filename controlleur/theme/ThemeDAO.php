<?php
include_once "/home/elloumi2u/Projet/path.php";
include_once ROOT_PATH."/controlleur/DAO.php";
interface ThemeDAO extends dao
{
  public function themeExiste($th);
  public function findAll();
}

 ?>
