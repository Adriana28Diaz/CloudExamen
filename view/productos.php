<!DOCTYPE html>
<?php
require_once '../model/Producto.php';
session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Facturación - productos</title>
        <script src="js/jquery-2.1.4.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/bootstrap-table.js"></script>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/bootstrap-table.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <img src="images/banner-facturacion.jpg">
            <div class="row">
                <h3>Productos</h3>
            </div>
            <div class="row">
                <a class="btn btn-success" href="../view/index.php">Inicio</a>
            </div>
            <p>
                <form action="../controller/controller.php">
                    <input type="hidden" name="opcion" value="crear_producto">
                    Código producto:<input type="number" name="codigo"  required="true">
                    Descripcion del producto:<input type="text" name="descripcion" maxlength="100" required="true">
                    Cantidad:<input type="decimal" name="cantidad"  required="true">
                    Precio:<input type="decimal" name="precio" required="true">
                    <input type="submit" value="Crear">
                </form>
            </p>
            <table data-toggle="table">
                <thead>
                    <tr>
                        <th>CODIGO</th>
                        <th>DESCRIPCION</th>
                        <th>CANTIDAD</th>
                        <th>PRECIO</th>
                        <th>OPCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //verificamos si existe en sesion el listado de productos:
                    if (isset($_SESSION['listaProductos'])) {
                        $listado = unserialize($_SESSION['listaProductos']);
                        foreach ($listado as $producto) {
                            echo "<tr>";
                            echo "<td>" . $producto->getCodigo() . "</td>";
                            echo "<td>" . $producto->getDescripcion() . "</td>";
                            echo "<td>" . $producto->getCantidad() . "</td>";
                            echo "<td>" . $producto->getPrecio() . "</td>";
                            echo "<td><a href='../controller/controller.php?opcion=eliminar_producto&codigo=" . $producto->getCodigo() . "'><span class='glyphicon glyphicon-pencil'> Eliminar </span></a></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "No se han cargado datos.";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </body>
</html>
