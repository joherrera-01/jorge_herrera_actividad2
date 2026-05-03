<?php
// En una arquitectura profesional, el index de la raíz redirige al login o al dashboard
session_start(); 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Inventario - Jorge Herrera</title>
    <script>
        // Verificación de Seguridad en Capa de Cliente (LocalStorage)
        const sesion = JSON.parse(localStorage.getItem('sesion_activa'));
        
        if (!sesion) {
            // Si no hay sesión, va directo al login
            window.location.href = "public/login.php";
        }
    </script>
</head>
<body>
    <script>
        // Si hay sesión, redirige al Menú Principal dentro de public
        window.location.href = "public/menu.php"; 
    </script>
</body>
</html>