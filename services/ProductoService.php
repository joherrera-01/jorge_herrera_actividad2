<?php
// ProductoService.php - Lógica de negocio para productos
class ProductoService {
    // En el Módulo 1, el Service PHP sirve como puente arquitectónico.
    // La lógica real de persistencia está en el Service de JavaScript.
    
    public function validarProducto($nombre, $precio, $stock) {
        if (empty($nombre)) return "El nombre es obligatorio.";
        if ($precio <= 0) return "El precio debe ser mayor a 0.";
        if ($stock < 0) return "El stock no puede ser negativo.";
        return true;
    }
}
?>