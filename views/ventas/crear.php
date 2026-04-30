<?php require_once 'views/layouts/header.php'; ?>
<div class="container">
    <h2>🛒 Realizar Venta</h2>
    <form method="POST">
        <p>Producto: <strong><?= htmlspecialchars($producto->nombre) ?></strong></p>
        <p>Stock disponible: <?= $producto->stock ?></p>
        <div class="form-group">
            <label>Cantidad:</label>
            <input type="number" name="cantidad" min="1" max="<?= $producto->stock ?>" required>
        </div>
        <button type="submit">✅ Confirmar Venta</button>
    </form>
</div>
<?php require_once 'views/layouts/footer.php'; ?>