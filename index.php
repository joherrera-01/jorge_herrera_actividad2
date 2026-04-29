<?php
require_once 'config/database.php';
require_once 'helpers/Validator.php';
require_once 'controllers/ProductoController.php';
require_once 'controllers/VentaController.php';

$controller = $_GET['c'] ?? 'productos';
$action = $_GET['a'] ?? 'index';

try {
    switch ($controller) {
        case 'productos':
            $ctrl = new ProductoController($pdo);
            $ctrl->{$action}();
            break;
        case 'ventas':
            $ctrl = new VentaController($pdo);
            $ctrl->{$action}();
            break;
        default:
            header('Location: ?c=productos&a=index');
    }
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}
?>
