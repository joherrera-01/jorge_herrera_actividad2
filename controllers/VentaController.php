<?php
require_once 'models/Venta.php';
require_once 'models/Producto.php';

class VentaController {
    private $model;
    private $prodModel;

    public function __construct($pdo) {
        $this->model = new Venta($pdo);
        $this->prodModel = new Producto($pdo);
    }

    public function index() {
        $ventas = $this->model->all();
        include 'views/ventas/index.php';
    }

    public function crear() {
    $id = $_GET['id'] ?? 0;
    $producto = $this->prodModel->find($id);

    if ($_POST) {
        try {
            $this->model->registrar($id, (int)$_POST['cantidad'], $producto->precio);
            header('Location: ?c=ventas&a=index&ok=1');
            exit;
        } catch (Exception $e) {
            $error = $e->getMessage(); // Capturamos el error de validación
        }
    }
    include 'views/ventas/crear.php';
}
}