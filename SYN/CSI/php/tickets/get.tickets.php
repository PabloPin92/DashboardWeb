<?php  
//Incluir archivo BDD

include_once("../clases/class.Database_SQL.php");

if(isset($_GET["pag"])){
	$pag = $_GET["pag"];
}else {
	$pag = 1;
}

session_start();
$user = strtolower($_SESSION['user']);


$respuesta = Database_SQL::get_todo_paginado('call_req',$pag,$user);

echo json_encode($respuesta);

?>