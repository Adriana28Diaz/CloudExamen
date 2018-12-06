<?php
/**
 * Clase utilitaria que maneja la conexion/desconexion a la base de datos
 * mediante las funciones PDO (PHP Data Objects).
 * Utiliza el patron de diseno singleton para el manejo de la conexion.

 */
class Database {
private static $dbName = 'productos' ;
    private static $dbHost = 'localhost' ;
    private static $dbUsername = 'postgres';
    private static $dbUserPassword = 'Adriana28';
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
