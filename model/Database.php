<?php
/**
 * Clase utilitaria que maneja la conexion/desconexion a la base de datos
 * mediante las funciones PDO (PHP Data Objects).
 * Utiliza el patron de diseno singleton para el manejo de la conexion.

 */
class Database {
private static $dbName = 'd52e3upa4uf753' ;
    private static $dbHost = 'ec2-54-225-100-12.compute-1.amazonaws.com' ;
    private static $dbUsername = 'cwpvekmbmtirgf';
    private static $dbUserPassword = '212fd72a01dbc1af07ef2d5c2f59dfce0fc338423c47fc0dff128c65b8e3cdda';
    private static $dbPort = '5432';
    private static $conexion  = null;

    public function __construct() {
        die('Init function is not allowed');
    }

    public static function connect()
    {
       // One connection through whole application
       if ( null == self::$conexion )
       {     
        try
        {
          //self::$cont =  new PDO( "pgsql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword); 
          //self::$conexion = new PDO("pgsql:dbname=" . self::$dbName . ";host=" .self::$dbHost . ";port=" .self::$dbPort, self::$dbUsername,  self::$dbUserPassword);
          self::$conexion =     new PDO("pgsql:dbname=" . self::$dbName . ";host=" .self::$dbHost, self::$dbUsername,  self::$dbUserPassword); 
        }
        catch(PDOException $e)
        {
          die($e->getMessage()); 
        }
       }
       return self::$conexion;
    }

    public static function disconnect()
    {
        self::$conexion = null;
    }

}

?>
