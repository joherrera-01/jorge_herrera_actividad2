<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sistema MVC - Jorge Herrera</title>
    <link rel="stylesheet" href="/jorge_herrera_actividad2/assets/css/style.css">
</head>
<body>
<header>
    <h1>🏗️ MVC - Inventario + Ventas</h1>
    <nav class="menu">
        <a href="?c=productos&a=index">📋 Productos</a>
        <?php
        $modulo = $_GET['c'] ?? 'productos';
        echo ($modulo == 'ventas') ? '<a href="?c=productos&a=index">🛒 Ir a Productos</a>' : '<a href="?c=productos&a=create">➕ Nuevo</a>';
        ?>
        <a href="?c=ventas&a=index">💰 Ventas</a>
    </nav>
</header>
<div class="container"> <!-- ABRIMOS EL CONTENEDOR AQUÍ -->