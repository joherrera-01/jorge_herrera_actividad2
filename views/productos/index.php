<h2>📋 Lista de Productos</h2>
<?php if (isset($_GET['ok'])): ?><div class="success">¡Operación exitosa!</div><?php endif; ?>
<table>
    <thead><tr><th>ID</th><th>Nombre</th><th>Stock</th><th>Precio</th><th>Acciones</th></tr></thead>
    <tbody>
    <?php foreach ($productos as $p): ?>
        <tr>
            <td><?= $p->id ?></td>
            <td><?= htmlspecialchars($p->nombre) ?></td>
            <td class="<?= $p->stock <= 5 ? 'low-stock' : '' ?>"><?= $p->stock ?></td>
            <td>$<?= number_format($p->precio, 2) ?></td>
            <td>
                <a href="?c=productos&a=edit&id=<?= $p->id ?>" class="btn-edit">✏️</a>
                <a href="?c=productos&a=delete&id=<?= $p->id ?>" onclick="return confirm('¿Eliminar?')" class="btn-delete">🗑️</a>
                <a href="?c=ventas&a=index&id=<?= $p->id ?>" class="btn-sell">🛒</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
