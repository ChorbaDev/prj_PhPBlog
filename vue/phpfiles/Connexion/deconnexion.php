<?php
include_once("/home/elloumi2u/Projet/path.php");
session_start();
$_SESSION[]=array();
session_destroy();
header('Location: '.BASE_URL.'/index.php');
?>