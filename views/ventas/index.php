<?php require_once 'views/layouts/header.php'; ?>
<div class="container">
    <h2>💰 Historial de Ventas</h2>
    <table>
        <thead><tr><th>Fecha</th><th>Producto</th><th>Cant</th><th>Total</th></tr></thead>
        <tbody>
            <?php foreach ($ventas as $v): ?>
            <tr>
                <td><?= $v->fecha ?></td>
                <td><?= $v->producto_nombre ?></td>
                <td><?= $v->cantidad ?></td>
                <td>$<?= number_format($v->total, 2) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php require_once 'views/layouts/footer.php'; ?>