<?php
// ======================================================
// Clase: class.Database_SQL.php
// Funcion: Se encarga del manejo con la base de datos
// Descripcion: Tiene varias funciones muy útiles para
//              el manejo de registros.
//
// Ultima Modificación: 17 de marzo de 2015
// ======================================================


class Database_SQL_Dashboard{

      private $_connection;
      private $_host = "10.10.11.17";
      private $_user = "dashboarduser";
      private $_pass = "Synergy00";
      private $_db   = "Dashboard";
    // ini_set('mssql.charset', 'UTF-8');

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
            trigger_error('class.Database_SQL_Dashboard.inc: $SQL enviado no es un string: ' .$sql);
            return false;
        }
        return true;
    }


    public static function get_valor_query($sql,$columna){

        if(!Database_SQL_Dashboard::es_string($sql,$columna))
            exit();

        //$db = Database_SQL_Dashboard::getInstancia();
        //$mysqli = Database_SQL_Dashboard::getConnection();
        $connectionInfo = array( "Database"=>"Dashboard", "UID"=>"dashboarduser", "PWD"=>"Synergy00");
        $conn = sqlsrv_connect( "10.10.11.17", $connectionInfo);
        if( !$conn ) {
            die( print_r( sqlsrv_errors(), true));
            }

        $resultado = sqlsrv_query($conn,$sql);

        // $conn = sqlsrv_connect($serverName, $connectionOptions);
        // $getProducts = sqlsrv_query($conn, $tsql);

        // Si hay un error en el SQL, este es el error de MySQL
        if (!$resultado ) {
            return sqlsrv_errors();

        }

        $Valor = NULL;
        //Trae el primer valor del arreglo

        if ($row = sqlsrv_fetch($resultado)) {
            // $Valor = array_values($row)[0];
            $Valor = $row;
        }
        sqlsrv_close( $conn );
        return $Valor;

    }

public static function ejecutar_idu($sql){

        if(!self::es_string($sql))
            exit();


        //$db = Database_SQL_Dashboard::getInstancia();
        //$mysqli = Database_SQL_Dashboard::getConnection();

        $connectionInfo = array( "Database"=>"Dashboard", "UID"=>"dashboarduser", "PWD"=>"Synergy00");
        $conn = sqlsrv_connect( "10.10.11.17", $connectionInfo);
        if( !$conn ) {
            die( print_r( sqlsrv_errors(), true));
            }

        $resultado = sqlsrv_query($conn,$sql);

        if (!$resultado) {
            return "class.Database_SQL_Dashboard.class: error ". sqlsrv_errors();
        }else{
            return $resultado;
        }

        sqlsrv_close( $conn );
        return $resultado;
    }

}


?>
