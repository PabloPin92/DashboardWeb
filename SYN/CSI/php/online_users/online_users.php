<?php  

include_once("../clases/class.Database_SQL.php");

$respuesta = Database_SQL::get_onlines();

echo json_encode($respuesta);

?>