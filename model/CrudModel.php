<?php
include_once 'Database.php';
include_once 'Producto.php';
/**
 * Clase para el manejo CRUD de clientes y productos.
 *
 * @author mrea
 */
class CrudModel {
    public function getProductos() {
        //obtenemos la informacion de la bdd:
        $pdo = Database::connect();
        $sql = "select * from producto";
        $resultado = $pdo->query($sql);
        //transformamos los registros en objetos:
        $listado = array();
        foreach ($resultado as $res) {
            $producto = new Producto($res['codigo'], $res['descripcion'], $res['cantidad'], $res['precio']);
            array_push($listado, $producto);
        }
        Database::disconnect();
        //retornamos el listado resultante:
        return $listado;
    }
    
    public function getProducto($codigo) {
        //obtenemos la informacion de la bdd:
        $pdo = Database::connect();
        $sql = "select * from producto where codigo=?";
        $consulta = $pdo->prepare($sql);
        $consulta->execute(array($codigo));
        //obtenemos el objeto especifico:
        $res=$consulta->fetch(PDO::FETCH_ASSOC);
        $producto=new Producto($res['codigo'], $res['descripcion'], $res['cantidad'], $res['precio']);
        Database::disconnect();
        //retornamos el objeto encontrado:
        return $producto;
    }

    /**
     * Inserta un nuevo producto en la bdd.
     * @param type $nombre
     * @param type $precio
     * @param type $porcentajeIva
     * @throws Exception
     */
    public function insertarProducto($codigo,$descripcion, $cantidad, $precio) {
        $pdo = Database::connect();
        $sql = "insert into producto(codigo, descripcion, cantidad, precio)VALUES (?, ?, ?, ?)";
        $consulta = $pdo->prepare($sql);
        //Ejecutamos y pasamos los parametros:
        try {
            $consulta->execute(array($codigo,$descripcion,$cantidad,$precio));
        } catch (PDOException $e) {
            Database::disconnect();
            throw new Exception($e->getMessage());
        }
        Database::disconnect();
    }
    
    /**
     * Elimina un producto especifico de la bdd.
     * @param type $idProducto
     */
    public function eliminarProducto($codigo){
        //Preparamos la conexion a la bdd:
        $pdo=Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql="delete from producto where codigo=?";
        $consulta=$pdo->prepare($sql);
        //Ejecutamos la sentencia incluyendo a los parametros:
        $consulta->execute(array($codigo));
        Database::disconnect();
    }
    /**
     * Actualiza un producto existente.
     * @param type $idProducto
     * @param type $nombre
     * @param type $precio
     * @param type $porcentajeIva
     */
    public function actualizarProducto($codigo, $descripcion,$cantidad, $precio){
        //Preparamos la conexión a la bdd:
        $pdo=Database::connect();
        $sql="update producto set descripcion=?,cantidad=?,precio=? where codigo=?";
        $consulta=$pdo->prepare($sql);
        //Ejecutamos la sentencia incluyendo a los parametros:
        $consulta->execute(array($codigo,$descripcion,$cantidad,$precio));
        Database::disconnect();
    }
}
