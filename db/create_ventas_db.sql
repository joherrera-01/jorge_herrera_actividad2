-- =====================================================
-- Script SQL: Sistema Inventario + Ventas MVC
-- Autor: Jorge Herrera Galan - ECOTEC 2026
-- BD: ventas_db | Clave: Ecotec2026*
-- Uso: phpMyAdmin → Nueva BD → Importar este archivo
-- =====================================================

-- 1. Crear base de datos
CREATE DATABASE IF NOT EXISTS `ventas_db` 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci;
USE `ventas_db`;

-- 2. Tabla PRINCIPAL: Productos (CRUD)
CREATE TABLE `productos` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `nombre` VARCHAR(100) NOT NULL,
    `stock` INT NOT NULL DEFAULT 0,
    `precio` DECIMAL(10,2) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    CHECK (`stock` >= 0),
    CHECK (`precio` > 0)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 3. Tabla BONUS: Ventas (historial)
CREATE TABLE `ventas` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `producto_id` INT NOT NULL,
    `cantidad` INT NOT NULL,
    `precio_unitario` DECIMAL(10,2) NOT NULL,
    `total` DECIMAL(10,2) NOT NULL,
    `fecha` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `idx_producto` (`producto_id`),
    CONSTRAINT `fk_ventas_producto` 
        FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 4. TRIGGER: Prohibir stock negativo (SEGURIDAD)
DELIMITER //
CREATE TRIGGER `trg_prevenir_stock_negativo` 
BEFORE UPDATE ON `productos`
FOR EACH ROW
BEGIN
    IF NEW.stock < 0 THEN
        SIGNAL SQLSTATE '45000' 
        SET MESSAGE_TEXT = '❌ ERROR: Stock no puede ser negativo';
    END IF;
END//

CREATE TRIGGER `trg_prevenir_insert_stock_negativo` 
BEFORE INSERT ON `productos`
FOR EACH ROW
BEGIN
    IF NEW.stock < 0 THEN
        SIGNAL SQLSTATE '45000' 
        SET MESSAGE_TEXT = '❌ ERROR: Stock no puede ser negativo';
    END IF;
END//
DELIMITER ;

-- 5. TRIGGER: Registrar venta automática (BONUS)
DELIMITER //
CREATE TRIGGER `trg_registrar_venta_automatica`
AFTER UPDATE ON `productos`
FOR EACH ROW
BEGIN
    IF OLD.stock > NEW.stock THEN
        INSERT INTO `ventas` (producto_id, cantidad, precio_unitario, total)
        VALUES (NEW.id, (OLD.stock - NEW.stock), NEW.precio, 
                (OLD.stock - NEW.stock) * NEW.precio);
    END IF;
END//
DELIMITER ;

-- 6. DATOS DE PRUEBA (5 productos listos para demo)
INSERT INTO `productos` (`nombre`, `stock`, `precio`) VALUES
('Laptop Dell XPS13', 8, 1250.99),
('Teclado Mecánico RGB', 25, 89.50),
('Mouse Logitech G502', 42, 45.99),
('Monitor Samsung 27"', 12, 289.00),
('SSD 1TB Kingston', 18, 89.99);

-- 7. Vista resumen BONUS (para reportes futuros)
CREATE VIEW `vista_inventario` AS
SELECT 
    p.id, p.nombre, p.stock, p.precio,
    (SELECT COUNT(*) FROM ventas v WHERE v.producto_id = p.id) as ventas_totales
FROM productos p;

-- 8. Procedimiento almacenado ejemplo (EXPANDIBLE)
DELIMITER //
CREATE PROCEDURE `sp_restock`(
    IN p_id INT,
    IN nueva_cantidad INT
)
BEGIN
    UPDATE productos SET stock = stock + nueva_cantidad WHERE id = p_id;
END//
DELIMITER ;

-- =====================================================
-- ✅ VERIFICACIÓN: Ejecuta estas consultas para probar
-- =====================================================
-- SELECT * FROM productos;
-- SELECT * FROM ventas;
-- SELECT * FROM vista_inventario;

-- =====================================================
-- 📋 CONSIDERACIONES INSTALACIÓN ECOTEC:
-- 1. XAMPP: Apache + MySQL corriendo
-- 2. phpMyAdmin → "Nueva" → nombre: ventas_db
-- 3. Importar este archivo (elige db/create_ventas_db.sql)
-- 4. Verifica: SELECT COUNT(*) FROM productos; → debe ser 5
-- 5. config/database.php ya tiene clave: Ecotec2026*
-- =====================================================

-- ¡Listo para MVC PHP! 🚀