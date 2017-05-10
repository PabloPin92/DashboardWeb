<?php  

require_once("../clases/class.Database_SQL.php");

session_start();
$user = $_SESSION['user'];


if (!isset($_SESSION['user'])){
  die;
}

$sql = "UPDATE Main_status set status = 'Offline' where Userid = '$user'";
$sql2 = "INSERT INTO StatusHistory VALUES ('$user', 'Offline', CURRENT_TIMESTAMP)";
Database_SQL::ejecutar_logout($sql);
Database_SQL::ejecutar_logout($sql2);

?>