<?php
///////////////////////////////////////////////////////////////////////
//Componente controller que verifica la opcion seleccionada
//por el usuario, ejecuta el modelo y enruta la navegacion de paginas.
///////////////////////////////////////////////////////////////////////
require_once '../model/CrudModel.php';
session_start();
//instanciamos los objetos de negocio:
$crudModel = new CrudModel();
//recibimos la opcion desde la vista:
$opcion = $_REQUEST['opcion'];
$mensajeError="";
//limpiamos cualquier mensaje previo:
unset($_SESSION['mensajeError']);
switch($opcion){
    case "listar_productos":
        //obtenemos la lista:
        $listaProductos = $crudModel->getProductos();
        //y los guardamos en sesion:
        $_SESSION['listaProductos'] = serialize($listaProductos);
        //redireccionamos a una nueva pagina para visualizar:
        header('Location: ../view/productos.php');
        break;
    case "editar_producto":
       $codigo=$_REQUEST['codigo'];
       $crudModel->actualizarProducto($codigo,$descripcion, $cantidad, $precio);
        
        $listaProductos = $crudModel->getProductos();
        //y los guardamos en sesion:
        $_SESSION['listaProductos'] = serialize($listaProductos);
        //redireccionamos a una nueva pagina para visualizar:
        header('Location: ../view/productos.php');
        break;
    case "eliminar_producto":
       $codigo=$_REQUEST['codigo'];
       $crudModel->eliminarProducto($codigo);
        $listaProductos = $crudModel->getProductos();
        //y los guardamos en sesion:
        $_SESSION['listaProductos'] = serialize($listaProductos);
        //redireccionamos a una nueva pagina para visualizar:
        header('Location: ../view/productos.php');
        break;
    case "crear_producto":
        //obtenemos los parametros del formulario:
        $codigo=$_REQUEST['codigo'];
        $descripcion=$_REQUEST['descripcion'];
        $cantidad=$_REQUEST['cantidad'];
        $precio=$_REQUEST['precio'];
        //creamos el nuevo registro:
        $crudModel->insertarProducto($codigo,$descripcion, $cantidad, $precio);
        //actualizamos el listado:
        $listaProductos = $crudModel->getProductos();
        //y los guardamos en sesion:
        $_SESSION['listaProductos'] = serialize($listaProductos);
        //redireccionamos a una nueva pagina para visualizar:
        header('Location: ../view/productos.php');
        break;
    default:
        //si no existe la opcion recibida por el controlador, siempre
        //redirigimos la navegacion a la pagina index:
        header('Location: ../view/index.php');
}

