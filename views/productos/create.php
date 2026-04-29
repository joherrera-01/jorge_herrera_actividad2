<h2>➕ Crear Producto</h2>
<form method="POST">
    <?php if ($errors): ?>
        <div class="error">
            <?php foreach ($errors as $field => $msg): ?>
                <p><?= ucfirst($field) ?>: <?= $msg ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    
    <div class="form-group">
        <label>Nombre <span class="required">*</span></label>
        <input type="text" name="nombre" value="<?= $_POST['nombre'] ?? '' ?>" required>
    </div>
    <div class="form-group">
        <label>Stock <span class="required">*</span></label>
        <input type="number" name="stock" min="0" value="<?= $_POST['stock'] ?? 0 ?>" required>
    </div>
    <div class="form-group">
        <label>Precio ($) <span class="required">*</span></label>
        <input type="number" name="precio" min="0.01" step="0.01" value="<?= $_POST['precio'] ?? '' ?>" required>
    </div>
    <button type="submit">💾 Guardar</button>
</form>
