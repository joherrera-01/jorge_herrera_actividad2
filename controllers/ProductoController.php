<?php
require_once '../models/Producto.php';
class ProductoController {
    public function index() {
        include '../public/productos.php';
    }
}