<?php
class Venta {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function vender($producto_id, $cantidad) {
        $stmt = $this->pdo->prepare("UPDATE productos SET stock = stock - ? WHERE id = ? AND stock >= ?");
        return $stmt->execute([$cantidad, $producto_id, $cantidad]);
    }

    public function getProducto($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM productos WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
}
?>
