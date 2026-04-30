<?php
class Producto {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function all() {
    $stmt = $this->pdo->query("SELECT p.*, c.nombre as categoria_nombre 
                               FROM productos p 
                               LEFT JOIN categorias c ON p.categoria_id = c.id 
                               ORDER BY p.id DESC");
    return $stmt->fetchAll();
    }

    public function find($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM productos WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($data) {
        $stmt = $this->pdo->prepare("INSERT INTO productos (nombre, stock, precio) VALUES (?, ?, ?)");
        return $stmt->execute([$data['nombre'], $data['stock'], $data['precio']]);
    }

    public function update($id, $data) {
        $stmt = $this->pdo->prepare("UPDATE productos SET nombre = ?, stock = ?, precio = ? WHERE id = ?");
        return $stmt->execute([$data['nombre'], $data['stock'], $data['precio'], $id]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM productos WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
