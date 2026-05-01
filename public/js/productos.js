// Servicio de datos (Simulando capa de persistencia)
const ProductoService = {
    get: () => JSON.parse(localStorage.getItem('productos')) || [],
    save: (data) => localStorage.setItem('productos', JSON.stringify(data))
};

// Función para mostrar los productos en la tabla
function renderProductos() {
    const prods = ProductoService.get();
    const tbody = document.getElementById('tbodyProductos');
    if (!tbody) return;
    
    tbody.innerHTML = '';
    prods.forEach((p, i) => {
        tbody.innerHTML += `
            <tr>
                <td>${p.nombre}</td>
                <td>$${parseFloat(p.precio).toFixed(2)}</td>
                <td>${p.stock}</td>
                <td class="text-center">
                    <button class="btn btn-warning btn-sm text-white" onclick="prepararEdicion(${i})">
                        <i class="bi bi-pencil"></i>
                    </button>
                    <button class="btn btn-danger btn-sm" onclick="eliminarProducto(${i})">
                        <i class="bi bi-trash"></i>
                    </button>
                </td>
            </tr>`;
    });
}

// Función para Guardar o Actualizar
function guardarProducto(e) {
    e.preventDefault(); // Evita que la página se recargue
    
    let prods = ProductoService.get();
    const nombre = document.getElementById('nombre').value.trim();
    const precio = parseFloat(document.getElementById('precio').value);
    const stock = parseInt(document.getElementById('stock').value);
    const editIdx = document.getElementById('editIndex').value;

    // Validaciones obligatorias del Módulo 1
    if (!nombre) return alert("El nombre es obligatorio");
    if (precio <= 0) return alert("El precio debe ser mayor a 0");
    if (stock < 0) return alert("El stock no puede ser negativo");

    const p = { nombre, precio, stock };

    if (editIdx === "") {
        // Nuevo producto
        prods.push(p);
    } else {
        // Editar producto existente
        prods[editIdx] = p;
        document.getElementById('editIndex').value = "";
        document.getElementById('btnOk').innerText = "Guardar";
        document.getElementById('btnOk').className = "btn btn-primary w-100";
    }

    ProductoService.save(prods); // Guardar en LocalStorage
    e.target.reset(); // Limpiar formulario
    renderProductos(); // Actualizar tabla
}

// Función para eliminar
function eliminarProducto(i) {
    if (confirm("¿Está seguro de eliminar este producto?")) {
        let prods = ProductoService.get();
        prods.splice(i, 1);
        ProductoService.save(prods);
        renderProductos();
    }
}

// Función para cargar datos en el formulario para editar
function prepararEdicion(i) {
    const p = ProductoService.get()[i];
    document.getElementById('nombre').value = p.nombre;
    document.getElementById('precio').value = p.precio;
    document.getElementById('stock').value = p.stock;
    document.getElementById('editIndex').value = i;
    
    const btn = document.getElementById('btnOk');
    btn.innerText = "Actualizar";
    btn.className = "btn btn-info text-white w-100";
}