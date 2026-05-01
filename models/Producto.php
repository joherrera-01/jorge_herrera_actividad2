<?php
class Producto {
    public $nombre;
    public $precio;
    public $stock;

    public function __construct($nombre, $precio, $stock) {
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->stock = $stock;
    }
}