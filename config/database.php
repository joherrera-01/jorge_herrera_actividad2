<?php
$host = 'localhost';
$dbname = 'ventas_db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
    ]);
} catch (PDOException $e) {
    http_response_code(500);
    die("Error BD. Inicia MySQL XAMPP e importa db/create_ventas_db.sql");
}
?>