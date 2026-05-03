<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Productos - Sistema Inventario</title>
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
                <li class="nav-item"><a class="nav-link active" href="productos.php">Productos</a></li>
                <li class="nav-item"><a class="nav-link" href="ventas.php">Ventas</a></li>
            </ul>
            <a href="menu.php" class="btn btn-outline-danger btn-sm">Volver al Menú</a>
        </div>
    </div>
</nav>

<div class="container main-container">
    <h2 class="mb-4"><i class="bi bi-box-seam"></i> Gestión de Productos</h2>
    
    <div class="card mb-4 shadow-sm border-0 bg-light">
        <div class="card-body">
            <form id="formProd" class="row g-3">
                <input type="hidden" id="editIndex" value="">
                <div class="col-md-4">
                    <label class="form-label fw-bold">Nombre</label>
                    <input type="text" id="nombre" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold">Precio</label>
                    <input type="number" id="precio" class="form-control" step="0.01" min="0.01" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold">Stock</label>
                    <input type="number" id="stock" class="form-control" min="0" required>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" id="btnOk" class="btn btn-primary w-100">Guardar</button>
                </div>
            </form>
        </div>
    </div>

    <table class="table table-hover bg-white shadow-sm">
        <thead class="table-dark">
            <tr>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Stock</th>
                <th class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody id="tbodyProductos"></tbody>
    </table>
</div>

<div id="liveAlertPlaceholder" class="position-fixed bottom-0 end-0 p-3" style="z-index: 11000"></div>

<footer class="text-center py-4 mt-auto">
    <p>&copy; 2026 Jorge Herrera - ECOTEC - Todos los derechos reservados</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/productos.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        renderProductos();
        document.getElementById('formProd').addEventListener('submit', guardarProducto);
    });
</script>
</body>
</html>