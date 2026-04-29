<?php
class Validator {
    public static function validateProducto($data) {
        $errors = [];
        if (empty(trim($data['nombre'] ?? ''))) $errors['nombre'] = 'Nombre requerido';
        if (!is_numeric($data['stock'] ?? 0) || ($data['stock'] < 0)) $errors['stock'] = 'Stock >= 0';
        if (!is_numeric($data['precio'] ?? 0) || ($data['precio'] <= 0)) $errors['precio'] = 'Precio > 0';
        return $errors;
    }
    
    public static function sanitize($data) {
        return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
    }
}
?>
