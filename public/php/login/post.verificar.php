<?php
session_start();
require_once("../clases/class.Database_SQL_Dashboard.php");
require_once("../clases/class.Database.php");


$postdata = file_get_contents("php://input");

$request = json_decode($postdata);
$request =  (array) $request;


$respuesta = array(
				'err' => true,
				'mensaje' => 'Usuario/Contraseña incorrectos',
			);



if(  isset( $request['usuario'] ) && isset( $request['contrasena'] ) ){ // ACTUALIZAR

	//$user = $request['usuario'];
	$existe = false;

	// Verificar que el usuario exista
	$sql = "SELECT count(*) as existe FROM Dashboard where Userid = '$user'";
	$existe = Database_SQL_Dashboard::get_valor_query( $sql, 'existe' );


	// $sql = "SELECT count(*) as existe FROM usuarios where codigo = '$user'";
	// $existe = Database::get_valor_query( $sql, 'existe' );

	// $user = strtoupper($user);




	if( $existe ){

		$user = addslashes( $request['usuario'] );
		$pass = addslashes( $request['contrasena'] );

		$sql = "SELECT contrasena FROM usuarios where codigo = '$user'";
		$data_pass = Database::get_valor_query( $sql, 'contrasena' );


		// Encriptar usando el mismo metodo
		//$pass = Database::uncrypt( $pass, $data_pass );

		// Verificar que sean iguales las contraseñas
		if( $data_pass == $pass ){

				if ($request['usuario'] == 'csi') {

				$respuesta = array(
				'err' => false,
				'mensaje' => 'Login valido',
				'url' => '../SYN/CSI/'
			);
				} else {
				$respuesta = array(
				'err' => false,
				'mensaje' => 'Login valido',
				'url' => '../SYN/'
			);
				}

		$_SESSION['user'] = $user;


			// actualizar ultimo acceso
			$sql = "UPDATE Main_status set status = 'Online' where Userid = '$user'";
			Database_SQL_Dashboard::ejecutar_idu($sql);
			$sql2 = "INSERT INTO StatusHistory VALUES ('$user', 'Online', CURRENT_TIMESTAMP)";
			Database_SQL_Dashboard::ejecutar_idu($sql2);
		}


	}

}

ob_end_clean();
// sleep(1.5);
echo json_encode( $respuesta);


// Esto se puede borrar despues
// ================================================
//   Funcion para Encriptar
// ================================================
// function encriptar_usuario(){

//  	$usuario_id = '1';
//  	$contrasena = '123456';
//  	$contrasena_crypt = Database::crypt( $contrasena );

//  	$sql = "UPDATE usuarios set contrasena = '$contrasena_crypt' where id = '$usuario_id'";
//  	Database::ejecutar_idu($sql);

//  }


?>
