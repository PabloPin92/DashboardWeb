<?php
// ======================================================
// Clase: class.Database_SQL.php
// Funcion: Se encarga del manejo con la base de datos
// Descripcion: Tiene varias funciones muy útiles para
//              el manejo de registros.
//
// Ultima Modificación: 17 de marzo de 2015
// ======================================================


class Database_SQL{

    // Almacenar una unica instancia
    private static $_instancia;

    // ================================================
    // Metodo para obtener instancia de base de datos
    // ================================================
    public static function getInstancia(){

        if(!isset(self::$_instancia)){
            self::$_instancia = new self;
        }


        return self::$_instancia;
    }

    // Metodo vacio __close para evitar duplicacion
    private function __close(){}

    // Metodo que revisa el String SQL
    private function es_string($sql){
        if (!is_string($sql)) {
            trigger_error('class.Database_SQL.inc: $SQL enviado no es un string: ' .$sql);
            return false;
        }
        return true;
    }


    public static function get_valor_query($sql,$columna){

      if(!Database_SQL::es_string($sql,$columna))
                  exit();

              //$db = Database_SQL::getInstancia();
              //$mysqli = Database_SQL::getConnection();

              $connectionInfo = array( "Database"=>"mdb", "UID"=>"dashboarduser", "PWD"=>"Synergy00");
              $conn = sqlsrv_connect( "10.10.11.17", $connectionInfo);
              if( !$conn ) {
                  die( print_r( sqlsrv_errors(), true));
                  }

              $resultado = sqlsrv_query($conn,$sql);

              // $conn = sqlsrv_connect($serverName, $connectionOptions);
              // $getProducts = sqlsrv_query($conn, $tsql);

              // Si hay un error en el SQL, este es el error de MySQL
              if (!$resultado ) {
                  return  sqlsrv_errors();

              }

              $Valor = NULL;
              //Trae el primer valor del arreglo

              if ($row = sqlsrv_fetch_array($resultado, SQLSRV_FETCH_ASSOC)) {
                  // $Valor = array_values($row)[0];
                  $Valor = $row[$columna];
              }
              sqlsrv_close( $conn );
              return $Valor;
    }

    public static function get_arreglo_dashboard($sql){

        if(!Database_SQL::es_string($sql))
            exit();

            //$db = Database_SQL::getInstancia();
            //$mysqli = Database_SQL::getConnection_dashboard();

        $connectionInfo = array( "Database"=>"Dashboard", "UID"=>"dashboarduser", "PWD"=>"Synergy00");
        $conn = sqlsrv_connect( "10.10.11.17", $connectionInfo);
        if( !$conn ) {
                die( print_r( sqlsrv_errors(), true));
                }

        $resultado = sqlsrv_query($conn,$sql);

        // Si hay un error en el SQL, este es el error de MySQL
        if (!$resultado ) {
            return sqlsrv_errors();
        }

        $i = 0;
        $registros = array();


        while($row = sqlsrv_fetch_array( $resultado, SQLSRV_FETCH_ASSOC )){

        $usuario_tickets = array_values($row)[0];

        $respuesta = Database_SQL::get_asignados( $usuario_tickets );

        $row["tickets_asignados"] = $respuesta;

            array_push( $registros, json_decode(json_encode(array_map('utf8_encode', $row)), FALSE));
            //array_push($registros, json_encode(array_map('utf8_encode', $row)));
        };
        sqlsrv_close( $conn );
        return $registros;

    }

    Public static function get_todo( $user ){

    $sql = "SELECT * FROM Main_Status WHERE Userid = '$user'";

    $datos = Database_SQL::get_arreglo_dashboard( $sql );

        $respuesta = array(
                'err'              => false,
                'usuario'		   => $user,
                'datos_usuario'    => $datos
                );


        //Database_SQL::close_connection_dashboard();
        return  $respuesta;

    }


    Public static function ejecutar_logout( $sql ){

    if(!self::es_string($sql))
            exit();

      $connectionInfo = array( "Database"=>"Dashboard", "UID"=>"dashboarduser", "PWD"=>"Synergy00");
      $conn = sqlsrv_connect( "10.10.11.17", $connectionInfo);
      if( !$conn ) {
                die( print_r( sqlsrv_errors(), true));
                }

      $resultado = sqlsrv_query($conn,$sql);

        $respuesta = array(
                'err'        => true,
                'mensaje'    => 'Log out fallido'
                );

        if (!$resultado) {
            return $respuesta;
        }else{
                $respuesta = array(
                'err'        => false,
                'mensaje'    => 'Log out exitoso'
                );

            return $respuesta;
        }
        sqlsrv_close( $conn );
        return $respuesta;

    }


Public static function get_onlines(){

  $sql = "SELECT * FROM Main_Status WHERE Status = 'Online'
  and Grupo = 'JBG N2'";

    $datos = Database_SQL::get_arreglo_dashboard( $sql );

          $respuesta = array(
                'err'              => false,
                'usuarios_online'    => $datos
                );


        return  $respuesta;

    }

Public static function get_asignados($usuario_tickets){

  //$db = Database_SQL::getInstancia();
//$mysqli = Database_SQL::getConnection();

$connectionInfo = array( "Database"=>"mdb", "UID"=>"dashboarduser", "PWD"=>"Synergy00");
$conn = sqlsrv_connect( "10.10.11.17", $connectionInfo);
if( !$conn ) {
die( print_r( sqlsrv_errors(), true));
}

    $sql = "SELECT COUNT (*) AS tickets_asignados FROM call_req INNER JOIN ca_contact on call_req.assignee = ca_contact.contact_uuid WHERE ca_contact.userid = '$usuario_tickets' AND (call_req.status not like 'CL' AND call_req.status not like 'CNCL' AND call_req.status not like 'RE' AND call_req.status not like 'ATEN' AND call_req.status not like 'PRBREJ')";

    $datos = sqlsrv_query($conn,$sql);

    if ($row = sqlsrv_fetch_array($datos, SQLSRV_FETCH_ASSOC)) {
                     $Valor = $row['tickets_asignados'];
                     return $Valor;
                     //print_r($row2);
                    }


        sqlsrv_close( $conn );
        return  $respuesta;

    }


    public static function get_arreglo($sql){

        if(!Database_SQL::es_string($sql))
            exit();

            //$db = Database_SQL::getInstancia();
            //$mysqli = Database_SQL::getConnection();

            $connectionInfo = array( "Database"=>"mdb", "UID"=>"dashboarduser", "PWD"=>"Synergy00");
            $conn = sqlsrv_connect( "10.10.11.17", $connectionInfo);
            if( !$conn ) {
            die( print_r( sqlsrv_errors(), true));
            }

            $resultado = sqlsrv_query($conn,$sql);


        // Si hay un error en el SQL, este es el error de MySQL
        if (!$resultado ) {
            return "class.Database.class: error ". sqlsrv_errors();
        }

        $i = 0;
        $registros = array();


        while($row = sqlsrv_fetch_array( $resultado, SQLSRV_FETCH_ASSOC )){
                array_push( $registros, json_decode(json_encode(array_map('utf8_encode', $row)), FALSE));

        };
        sqlsrv_close( $conn );
        return $registros;

    }

    // ================================================
    //   Funcion que pagina cualquier TABLA
    // ================================================
    Public static function get_todo_paginado( $tabla,$pagina = 1,$user, $por_pagina = 50 ){

        // Core de la funcion
        //$db = Database_SQL::getInstancia();
        //$mysqli = Database_SQL::getConnection();


        $sql = "SELECT COUNT (*) AS cuantos FROM $tabla INNER JOIN ca_contact on call_req.assignee = ca_contact.contact_uuid WHERE ca_contact.userid = '$user' AND (call_req.status not like 'CL' AND call_req.status not like 'CNCL' AND call_req.status not like 'RE' AND call_req.status not like 'ATEN' AND call_req.status not like 'PRBREJ')";


        $cuantos       = Database_SQL::get_valor_query( $sql, 'cuantos' );
        $total_paginas = ceil( $cuantos / $por_pagina );

        if( $pagina > $total_paginas ){
            $pagina = $total_paginas;
        }


        $pagina -= 1;  // 0
        $desde   = $pagina * $por_pagina; // 0 * 20 = 0

        if( $pagina >= $total_paginas-1 ){
            $pag_siguiente = 1;
        }else{
            $pag_siguiente = $pagina + 2;
        }

        if( $pagina < 1 ){
            $pag_anterior = $total_paginas;
        }else{
            $pag_anterior = $pagina;
        }


    $sql = "SELECT ref_num, UPPER(crt.sym) +' - '+ summary resumen, priority prioridad, cr_stat.sym estado, CONVERT(nvarchar,DATEADD(SECOND,call_req.open_date-18000,'19700101'),120) Fecha_ap, asig.last_name + ' ' + asig.first_name asignatario, cust.last_name + ' ' + cust.first_name customer FROM $tabla left join cr_stat on call_req.status = cr_stat.code Left join ca_contact asig on call_req.assignee = asig.contact_uuid Left join ca_contact cust on call_req.assignee = cust.contact_uuid INNER JOIN ca_contact on call_req.assignee = ca_contact.contact_uuid inner join crt on call_req.type = crt.code WHERE ca_contact.userid = '$user' AND (call_req.status not like 'CL' AND call_req.status not like 'CNCL' AND call_req.status not like 'RE' AND call_req.status not like 'ATEN' AND  call_req.status not like 'PRBREJ') ORDER BY ref_num";

    $datos = Database_SQL::get_arreglo( $sql );

    //echo gettype($datos);

        //$resultado = sqlsrv_query($mysqli,$sql);

        $arrPaginas = array();
        for ($i=0; $i < $total_paginas; $i++) {
            array_push($arrPaginas, $i+1);
        }

        $respuesta = array(
                'err'           => false,
                'conteo'        => "$cuantos",
                'tickets'       => $datos,
                'pag_actual'    => ($pagina+1),
                'pag_siguiente' => $pag_siguiente,
                'pag_anterior'  => $pag_anterior,
                'total_paginas' => $total_paginas,
                'paginas'       => $arrPaginas
                );


        return  $respuesta;

    }

}


?>
