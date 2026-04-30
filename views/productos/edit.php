<?php require_once 'views/layouts/header.php'; ?>

<div class="container">
    <h2>✏️ Editar Producto: <?= htmlspecialchars($producto->nombre) ?></h2>

    <?php if (!empty($errors)): ?>
        <div class="error">
            <?php foreach ($errors as $field => $msg): ?>
                <p><?= ucfirst($field) ?>: <?= $msg ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form method="POST">
        <div class="form-group">
            <label>Nombre:</label>
            <input type="text" name="nombre" value="<?= htmlspecialchars($producto->nombre) ?>" required>
        </div>
        
        <div class="form-group">
            <label>Stock:</label>
            <input type="number" name="stock" min="0" value="<?= $producto->stock ?>" required>
        </div>
        
        <div class="form-group">
            <label>Precio ($):</label>
            <input type="number" name="precio" min="0.01" step="0.01" value="<?= $producto->precio ?>" required>
        </div>
        
        <button type="submit">💾 Actualizar Cambios</button>
    </form>
</div>

<?php require_once 'views/layouts/footer.php'; ?>