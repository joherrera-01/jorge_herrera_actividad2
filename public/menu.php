<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Menú Principal - Sistema de Inventario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Estilo para el fondo de la página principal */
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            color: white;
        }

        .container {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        /* Estilo para las tarjetas del menú */
        .card {
            background: rgba(255, 255, 255, 0.9);
            border: none;
            border-radius: 15px;
            transition: transform 0.3s ease;
            color: #333;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }

        .display-4 {
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        footer {
            background: rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(5px);
        }

        /* Estilo para el botón salir sin romper el diseño */
        .btn-logout {
            position: absolute;
            top: 20px;
            right: 20px;
        }
    </style>
</head>
<body>

<div class="btn-logout">
    <button onclick="logout()" class="btn btn-outline-light btn-sm">
        <i class="bi bi-box-arrow-right"></i> Cerrar Sesión
    </button>
</div>

<div class="container text-center">
    <h1 class="display-4 mb-2">Sistema Web de Inventario</h1>
    <p class="lead mb-5">Jorge Herrera - Módulo 1 (LocalStorage)</p>
    
    <div class="row justify-content-center g-4">
        <div class="col-md-5 col-lg-4">
            <div class="card shadow p-4">
                <div class="card-body">
                    <div class="mb-3">
                        <i class="bi bi-box-seam" style="font-size: 3rem; color: #667eea;"></i>
                    </div>
                    <h3 class="card-title">Productos</h3>
                    <p class="card-text text-muted">Gestión completa de productos: Crear, Listar, Editar y Eliminar.</p>
                    <a href="productos.php" class="btn btn-primary btn-lg w-100 mt-3">Ir a Productos</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-5 col-lg-4">
            <div class="card shadow p-4">
                <div class="card-body">
                    <div class="mb-3">
                        <i class="bi bi-cart-check" style="font-size: 3rem; color: #764ba2;"></i>
                    </div>
                    <h3 class="card-title">Ventas</h3>
                    <p class="card-text text-muted">Registro de transacciones y consulta del historial de ventas.</p>
                    <a href="ventas.php" class="btn btn-success btn-lg w-100 mt-3">Ir a Ventas</a>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="text-center py-3 border-top mt-auto">
    <p class="mb-0">&copy; 2026 Jorge Herrera - ECOTEC - Todos los derechos reservados</p>
</footer>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

<script>
    // Capa de seguridad obligatoria
    const sesion = JSON.parse(localStorage.getItem('sesion_activa'));
    if (!sesion) {
        window.location.href = "login.php";
    }

    function logout() {
        localStorage.removeItem('sesion_activa');
        window.location.href = "login.php";
    }
</script>

</body>
</html>