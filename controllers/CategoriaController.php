<?php
require_once 'models/Categoria.php';
class CategoriaController {
    private $model;
    public function __construct($pdo) { $this->model = new Categoria($pdo); }
    public function index() {
        $categorias = $this->model->all();
        include 'views/categorias/index.php';
    }
    public function create() {
        if ($_POST) {
            $this->model->create($_POST['nombre']);
            header('Location: ?c=categorias&a=index');
        }
        include 'views/categorias/create.php';
    }
}