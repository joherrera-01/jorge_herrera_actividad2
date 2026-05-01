<?php
// Se incluye el modelo correspondiente
require_once '../models/Venta.php';

class VentaController {
    
    // Función para cargar la interfaz de ventas
    public function index() {
        // El controlador decide qué vista mostrar
        include '../public/ventas.php';
    }

    // En el futuro, aquí se procesarán los reportes de ventas
}
?>