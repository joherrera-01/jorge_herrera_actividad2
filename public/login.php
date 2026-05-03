<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - Sistema Inventario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/estilos.css">
    <style>
        .login-container {
            max-width: 400px;
            margin: 100px auto;
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-container text-center">
            <h2 class="mb-4">Iniciar Sesión</h2>
            <form id="formLogin">
                <div class="mb-3 text-start">
                    <label class="form-label fw-bold">Usuario</label>
                    <input type="text" id="user" class="form-control" placeholder="admin" required>
                </div>
                <div class="mb-3 text-start">
                    <label class="form-label fw-bold">Contraseña</label>
                    <input type="password" id="pass" class="form-control" placeholder="1234" required>
                </div>
                <button type="submit" class="btn btn-primary w-100 btn-lg">Ingresar</button>
            </form>
            <p class="text-muted mt-3 small">Jorge Herrera - Sistema de Inventario</p>
        </div>
    </div>

    <script src="js/login.js"></script>
</body>
</html>