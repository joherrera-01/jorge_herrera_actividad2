<?php
require_once 'models/Producto.php';
require_once 'helpers/Validator.php';


class ProductoController {
    private $model;
    private $validator;

    public function __construct($pdo) {
        $this->model = new Producto($pdo);
        $this->validator = new Validator();
    }

    public function index() {
        $productos = $this->model->all();
        include 'views/productos/index.php';
    }

    public function create() {
        $errors = [];
        if ($_POST) {
            $errors = $this->validator->validateProducto($_POST);
            if (empty($errors)) {
                $data = [
                    'nombre' => $this->validator->sanitize($_POST['nombre']),
                    'stock' => (int)$_POST['stock'],
                    'precio' => (float)$_POST['precio']
                ];
                if ($this->model->create($data)) {
                    header('Location: ?c=productos&a=index&ok=1');
                    exit;
                }
            }
        }
        include 'views/productos/create.php';
    }

    public function edit() {
        $id = $_GET['id'] ?? 0;
    // 1. Obtenemos el producto de la BD
    $producto = $this->model->find($id); 
    
    // 2. Si no existe, volvemos a la lista
    if (!$producto) header('Location: ?c=productos&a=index');

    $errors = [];
    if ($_POST) {
        // ... (Aquí va tu lógica de validación y actualización) ...
        $data = [
            'nombre' => $this->validator->sanitize($_POST['nombre']),
            'stock' => (int)$_POST['stock'],
            'precio' => (float)$_POST['precio']
        ];
        if ($this->model->update($id, $data)) {
            header('Location: ?c=productos&a=index&ok=1');
            exit;
        }
    }
    // 3. Cargar la vista (aquí es donde la variable $producto llega a edit.php)
    include 'views/productos/edit.php';
    }

    public function delete() {
        $id = $_GET['id'] ?? 0;
        if ($id) $this->model->delete($id);
        header('Location: ?c=productos&a=index');
    }
}
?>

