# jorge_herrera_actividad2
sistema ventas con pho+mysql
# 🚀 Actividad Integradora 2 - JORGE HERRERA GALAN - ECOTEC

## 📖 Descripción del Sistema
Sistema web desarrollado en **PHP puro (Arquitectura MVC)**.
- **Módulos**: Gestión de Productos, Categorías y Ventas.
- **Relaciones**: Producto pertenece a una Categoría.
- **Seguridad**: PDO, Transacciones SQL, validaciones en modelo.

## 🛠️ Tecnologías
- PHP 8.x
- MySQL (InnoDB)
- CSS3 (Responsive Design)

## 📋 Requisitos de Instalación
1. Importar `db/create_ventas_db.sql` en MySQL (`ventas_db`).
2. Configurar `config/database.php` con credenciales de tu servidor.
3. Asegurar acceso a la carpeta en `localhost`.

## 🗄️ Modelo de Datos (ERD)
- **Categorías** (1) <--- (N) **Productos**
- **Productos** (1) <--- (N) **Ventas**

## 👤 Usuario de Prueba
Acceso libre. Las validaciones de stock y precio son estrictas.

---
**Jorge Herrera Galan** | ECOTEC 2026
