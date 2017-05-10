<?php
session_start();

$postdata = file_get_contents("php://input");

$request = json_decode($postdata);
$request =  (array) $request;


$respuesta = array(
				'err' => true,
				'mensaje' => 'Usuario/Contraseña incorrectos',
			);


if(  isset( $request['usuario'] ) && isset( $request['contrasena'] ) ){ // ACTUALIZAR

	$user = "uid=".$request['usuario'].",dc=example,dc=com";
	//$user = $request['usuario'];
	$pass = addslashes( $request['contrasena'] );

    //$adServer = "jbg21cd01.central.jbgye.org.ec";
    //$adServer = "LDAP://jbg21cd01.central.jbgye.org.ec";
    $adServer = "ldap.forumsys.com";
	
	//$user = strtoupper($user);

	//$ldap_dn = "uid=".$user.",dc=example,dc=com";
	$ldap_dn = $user;
	$ldap_password = $pass;
	//$ldap_con = ldap_connect("ldap.forumsys.com");

	$ldap_con = ldap_connect($adServer);
	//$ldapconfig['basedn'] = 'dc=central,dc=jbgye.org.ec';

	ldap_set_option($ldap_con, LDAP_OPT_PROTOCOL_VERSION, 3);
	//ldap_set_option($ldap_con, LDAP_OPT_REFERRALS, 0);

	//if(@ldap_bind($ldap_con,$_POST[$ldap_dn],$_POST[$ldap_password])){

	 if(@ldap_bind($ldap_con,$ldap_dn,$ldap_password)){

	 	 	$respuesta = array(
	 		'err' => false,
	 		'mensaje' => 'Login valido',
	 		'url' => '../SYN/');

	 	$_SESSION['user'] = $user;

	 };
		


};
	

// sleep(1.5);
echo json_encode( $respuesta );

?>