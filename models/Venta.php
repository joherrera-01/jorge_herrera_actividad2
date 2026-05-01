<?php
class Venta {
    public $fecha;
    public $productoNom;
    public $cantidad;

    public function __construct($productoNom, $cantidad) {
        $this->fecha = date('Y-m-d H:i:s');
        $this->productoNom = $productoNom;
        $this->cantidad = $cantidad;
    }
}