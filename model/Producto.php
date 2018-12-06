<?php
/**
 * Description of Producto
 *
 * @author mrea
 */
class Producto {
    private $codigo;
    private $descripcion;
    private $cantidad;
    private $precio;
    
    function __construct($codigo, $descripcion, $cantidad, $precio) {
        $this->codigo = $codigo;
        $this->descripcion = $descripcion;
        $this->cantidad = $cantidad;
        $this->precio = $precio;
    }
    function getCodigo() {
        return $this->codigo;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getCantidad() {
        return $this->cantidad;
    }

    function getPrecio() {
        return $this->precio;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }

    function setPrecio($precio) {
        $this->precio = $precio;
    }


}
