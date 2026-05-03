// Servicio de datos
const ProductoService = {
    get: () => JSON.parse(localStorage.getItem('productos')) || [],
    save: (data) => localStorage.setItem('productos', JSON.stringify(data))
};

// --- NUEVA FUNCIÓN DE ALERTAS ---
function mostrarMensaje(mensaje, tipo = 'success') {
    const alertPlaceholder = document.getElementById('liveAlertPlaceholder');
    if (!alertPlaceholder) return;

    const wrapper = document.createElement('div');
    const icono = tipo === 'success' ? 'bi-check-circle' : (tipo === 'danger' ? 'bi-trash' : 'bi-info-circle');

    wrapper.innerHTML = [
        `<div class="alert alert-${tipo} alert-dismissible fade show shadow-lg" role="alert" style="border-left: 5px solid;">`,
        `   <div><i class="bi ${icono} me-2"></i>${mensaje}</div>`,
        '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
        '</div>'
    ].join('');

    alertPlaceholder.append(wrapper);

    // Auto-eliminar después de 3 segundos
    setTimeout(() => {
        const alertElement = wrapper.querySelector('.alert');
        if (alertElement) {
            const bsAlert = new bootstrap.Alert(alertElement);
            bsAlert.close();
        }
    }, 3000);
}

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
                    <button class="btn btn-warning btn-sm text-white me-1" 
                            onclick="prepararEdicion(${i})" 
                            data-tooltip="Editar Producto">
                        <i class="bi bi-pencil"></i>
                    </button>
                    <button class="btn btn-danger btn-sm" 
                            onclick="eliminarProducto(${i})" 
                            data-tooltip="Eliminar Producto">
                        <i class="bi bi-trash"></i>
                    </button>
                </td>
            </tr>`;
    });
}

// Función para Guardar o Actualizar
function guardarProducto(e) {
    e.preventDefault();
    
    let prods = ProductoService.get();
    const nombre = document.getElementById('nombre').value.trim();
    const precio = parseFloat(document.getElementById('precio').value);
    const stock = parseInt(document.getElementById('stock').value);
    const editIdx = document.getElementById('editIndex').value;

    if (!nombre) return alert("El nombre es obligatorio");
    if (precio <= 0) return alert("El precio debe ser mayor a 0");
    if (stock < 0) return alert("El stock no puede ser negativo");

    const p = { nombre, precio, stock };

    if (editIdx === "") {
        // NUEVO PRODUCTO
        prods.push(p);
        mostrarMensaje("¡Producto guardado exitosamente!"); 
    } else {
        // EDITAR PRODUCTO
        prods[editIdx] = p;
        document.getElementById('editIndex').value = "";
        document.getElementById('btnOk').innerText = "Guardar";
        document.getElementById('btnOk').className = "btn btn-primary w-100";
        mostrarMensaje("Producto actualizado correctamente", "info");
    }

    ProductoService.save(prods);
    e.target.reset();
    renderProductos();
}

// Función para eliminar
function eliminarProducto(i) {
    if (confirm("¿Está seguro de eliminar este producto?")) {
        let prods = ProductoService.get();
        prods.splice(i, 1);
        ProductoService.save(prods);
        renderProductos();
        mostrarMensaje("Producto eliminado correctamente", "danger");
    }
}

// Función para preparar edición
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