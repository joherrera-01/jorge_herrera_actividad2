<?php
class Venta {
    private $pdo;
    public function __construct($pdo) { 
        $this->pdo = $pdo; 
        }
     public function all() {
        $stmt = $this->pdo->query("SELECT v.*, p.nombre as producto_nombre 
                                   FROM ventas v 
                                   JOIN productos p ON v.producto_id = p.id 
                                   ORDER BY v.fecha DESC");
        return $stmt->fetchAll();
    }
    public function registrar($producto_id, $cantidad, $precio) {
        // Validaciones de negocio
        if ($cantidad <= 0) throw new Exception("La cantidad debe ser mayor a 0.");

        try {
            $this->pdo->beginTransaction();

            // 1. Verificamos stock actual dentro de la transacción
            $stmt = $this->pdo->prepare("SELECT stock FROM productos WHERE id = ? FOR UPDATE");
            $stmt->execute([$producto_id]);
            $producto = $stmt->fetch();

            if (!$producto || $producto->stock < $cantidad) {
                throw new Exception("Stock insuficiente para esta venta.");
            }

            // 2. Insertamos la venta
            $stmt = $this->pdo->prepare("INSERT INTO ventas (producto_id, cantidad, precio_unitario, total) VALUES (?, ?, ?, ?)");
            $stmt->execute([$producto_id, $cantidad, $precio, ($cantidad * $precio)]);

            // 3. Descontamos el stock
            $stmt = $this->pdo->prepare("UPDATE productos SET stock = stock - ? WHERE id = ?");
            $stmt->execute([$cantidad, $producto_id]);

            $this->pdo->commit();
            return true;
        } catch (Exception $e) {
            $this->pdo->rollBack();
            throw $e; // Lanzamos el error para que el controlador lo muestre
        }
    }
}