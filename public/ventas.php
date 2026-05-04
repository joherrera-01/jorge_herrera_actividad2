<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ventas - Sistema Inventario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4 shadow">
    <div class="container">
        <a class="navbar-brand" href="menu.php">Sistema Inventario</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="productos.php">Productos</a></li>
                <li class="nav-item"><a class="nav-link active" href="ventas.php">Ventas</a></li>
            </ul>
            <a href="menu.php" class="btn btn-outline-danger btn-sm">Volver al Menú</a>
        </div>
    </div>
</nav>

<div class="container main-container">
    <h2 class="mb-4"><i class="bi bi-cart-check"></i> Gestión de Ventas</h2>
    
    <div class="card mb-4 shadow-sm border-0 bg-light">
        <div class="card-body">
            <form id="formVenta" class="row g-3">
                <input type="hidden" id="editVentaIndex" value="">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Seleccionar Producto</label>
                    <select id="selectProd" class="form-select" required>
                        </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold">Cantidad</label>
                    <input type="number" id="cantVenta" class="form-control" min="1" required>
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" id="btnVenta" class="btn btn-success w-100">
                        <i class="bi bi-cart-plus"></i> Vender
                    </button>
                </div>
            </form>
        </div>
    </div>

    <h4><i class="bi bi-list-stars"></i> Historial de Transacciones</h4>
    <div class="table-responsive">
        <table class="table table-hover bg-white mt-3 shadow-sm">
            <thead class="table-dark">
                <tr>
                    <th>Fecha</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody id="tbodyVentas"></tbody>
        </table>
    </div>
</div>

<div id="liveAlertPlaceholder" class="position-fixed bottom-0 end-0 p-3" style="z-index: 11000"></div>

<footer class="text-center py-4 mt-auto">
    <p>&copy; 2026 Jorge Herrera - ECOTEC - Todos los derechos reservados</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/ventas.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        renderVentas();
        document.getElementById('formVenta').addEventListener('submit', procesarVenta);
    });
</script>
</body>
</html>