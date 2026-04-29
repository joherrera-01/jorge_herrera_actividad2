<?php
require_once 'models/Venta.php';
require_once 'views/layouts/header.php';

class VentaController {
    private $model;

    public function __construct($pdo) {
        $this->model = new Venta($pdo);
    }

    public function index() {
        $id = $_GET['id'] ?? 0;
        $producto = $this->model->getProducto($id);
        
        if ($_POST && isset($_POST['vender'])) {
            $cantidad = (int)$_POST['cantidad'];
            if ($cantidad > 0 && $cantidad <= $producto->stock) {
                $this->model->vender($id, $cantidad);
                $mensaje = "¡Venta exitosa! -$cantidad stock";
            } else {
                $error = "Cantidad inválida (max: {$producto->stock})";
            }
        }
        include 'views/ventas/index.php';
    }
}
?>
<?php require_once 'views/layouts/footer.php'; ?>

