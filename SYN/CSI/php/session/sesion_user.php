<?php  

include_once("../clases/class.Database_SQL.php");

session_start();
$user = $_SESSION['user'];


if (!isset($_SESSION['user'])){
  die;
}


$respuesta = Database_SQL::get_todo($user);

echo json_encode($respuesta);

?>