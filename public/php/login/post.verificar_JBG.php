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

//We just need six varaiables here
$baseDN = 'DC=central,DC=jbgye,DC=org,DC=ec';
$adminDN = "CN=Pablo Javier Pin Parrales,OU=Sin Restriccion,OU=Departamento Usuarios,OU=Dep Cementerio General,DC=central,DC=jbgye,DC=org,DC=ec";//this is the admin distinguishedName
$adminPswd = "Setel371";
$username = addslashes($request['usuario']);//this is the user samaccountname
$userpass = addslashes( $request['contrasena'] );
$ldap_conn = ldap_connect("JBG21CD01");//I'm using LDAPS here
ldap_set_option($ldap_conn, LDAP_OPT_REFERRALS, 0);
ldap_set_option($ldap_conn, LDAP_OPT_PROTOCOL_VERSION, 3);

$ldapBindAdmin = ldap_bind($ldap_conn, $adminDN, $adminPswd);

if ($ldapBindAdmin){
    //echo ("<p style='color: green;'>Admin binding and authentication successful!!!</p>");

    $filter = '(sAMAccountName='.$username.')';
    $attributes = array("name", "telephonenumber", "mail", "samaccountname");
    $result = ldap_search($ldap_conn, $baseDN, $filter, $attributes);

    $entries = ldap_get_entries($ldap_conn, $result);  
    $userDN = $entries[0]["name"][0];
	$samAcn = $entries[0]["samaccountname"][0];
	$test = system("dsquery user -samid".$username);
    // echo ('<p style="color:green;">I have the user DN: '.$samAcn.'</p>');
	// echo ('<p style="color:green;">I have the user DN: '.$userDN.'</p>');

    //Okay, we're in! But now we need bind the user now that we have the user's DN
    $ldapBindUser = ldap_bind($ldap_conn, $test, $userpass);
    //$ldapBindUser = ldap_bind($ldap_conn, "CN=".$userDN, $userpass);

    if($ldapBindUser){
        //echo ("<p style='color: green;'>User binding and authentication successful!!!</p>");        
		
			$respuesta = array(
	 		'err' => false,
	 		'mensaje' => 'Login valido',
	 		'url' => '../SYN/');

	 	$_SESSION['user'] = $username;
		
        //ldap_unbind($ldap_conn); // Clean up after ourselves.

    }; 
}; 

};
	
ob_end_clean();
// sleep(1.5);
echo json_encode( $respuesta );

?>