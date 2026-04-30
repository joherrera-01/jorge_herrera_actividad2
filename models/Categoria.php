<?php
class Categoria {
    private $pdo;
    public function __construct($pdo) { $this->pdo = $pdo; }
    public function all() { return $this->pdo->query("SELECT * FROM categorias")->fetchAll(); }
    public function create($nombre) {
        $stmt = $this->pdo->prepare("INSERT INTO categorias (nombre) VALUES (?)");
        return $stmt->execute([$nombre]);
    }
}