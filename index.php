<?php
session_start();

include "./PHP/CONTROLLER/Outils.php";
spl_autoload_register("ChargerClasse");
if (isset($_SESSION['parameters'])) {
  $param = new Gen__Parameters($_SESSION['parameters']);
  $co = DBConnect::Connect();
}
include './PHP/VIEW/header.php';
// var_dump($_GET);
// var_dump($_POST);
if (isset($_GET['page'])) {
  switch ($_GET['page']) {
    case 'ActionBDD':
      include '.\PHP\CONTROLLER\ACTION\ActionBDD.php';
      break;
    case 'tables':
      include './PHP/VIEW/ListeTables.php';
      break;
    case 'creationFiles':
      include '.\PHP\CONTROLLER\ACTION\creationFiles.php';
      break;
    default:
      include './PHP/VIEW/main.php';
      break;
  }
} else {
  include './PHP/VIEW/main.php';
}
