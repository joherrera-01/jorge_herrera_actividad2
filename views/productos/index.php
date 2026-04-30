<?php require_once 'views/layouts/header.php'; ?>

<div class="container">
    <h2>📋 Lista de Productos</h2>
    
    <?php if (isset($_GET['ok'])): ?>
        <div class="success">¡Operación realizada con éxito!</div>
    <?php endif; ?>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Stock</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productos as $p): ?>
            <tr>
                <td><?= $p->id ?></td>
                <td><?= htmlspecialchars($p->nombre) ?></td>
                <td class="<?= $p->stock <= 5 ? 'low-stock' : '' ?>"><?= $p->stock ?></td>
                <td>$<?= number_format($p->precio, 2) ?></td>
                <!-- Dentro del foreach de tu tabla en index.php -->
<td>
    <a href="?c=productos&a=edit&id=<?= $p->id ?>" class="btn-edit" title="Editar">✏️</a>
    <a href="?c=productos&a=delete&id=<?= $p->id ?>" onclick="return confirm('¿Seguro?')" class="btn-delete" title="Eliminar">🗑️</a>
    <!-- Este es el botón para iniciar la venta -->
    <a href="?c=ventas&a=crear&id=<?= $p->id ?>" class="btn-sell" title="Vender">🛒</a>
</td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once 'views/layouts/footer.php'; ?>