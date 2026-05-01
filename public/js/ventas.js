// Capa de Datos (Persistencia en LocalStorage)
const VentaService = {
    getVentas: () => JSON.parse(localStorage.getItem('ventas')) || [],
    getProds: () => JSON.parse(localStorage.getItem('productos')) || [],
    saveAll: (ventas, productos) => {
        localStorage.setItem('ventas', JSON.stringify(ventas));
        localStorage.setItem('productos', JSON.stringify(productos));
    }
};

// Función para renderizar tabla y select de productos
function renderVentas() {
    const ventas = VentaService.getVentas();
    const prods = VentaService.getProds();
    
    // Rellenar el Select de productos
    const select = document.getElementById('selectProd');
    if (select) {
        select.innerHTML = '<option value="">Seleccione un producto...</option>';
        prods.forEach((p, i) => {
            select.innerHTML += `<option value="${i}">${p.nombre} (Stock: ${p.stock})</option>`;
        });
    }

    // Rellenar la Tabla de historial
    const tbody = document.getElementById('tbodyVentas');
    if (tbody) {
        tbody.innerHTML = '';
        ventas.forEach((v, i) => {
            tbody.innerHTML += `
                <tr>
                    <td>${v.fecha}</td>
                    <td>${v.productoNom}</td>
                    <td>${v.cantidad}</td>
                    <td class="text-center">
                        <button class="btn btn-info btn-sm text-white me-1" onclick="prepararEdicionVenta(${i})">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button class="btn btn-danger btn-sm" onclick="eliminarVenta(${i})">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>`;
        });
    }
}

// Función principal para Registrar o Modificar
function procesarVenta(e) {
    e.preventDefault();
    
    let prods = VentaService.getProds();
    let ventas = VentaService.getVentas();
    
    const pIdx = document.getElementById('selectProd').value;
    const nuevaCant = parseInt(document.getElementById('cantVenta').value);
    const editIdx = document.getElementById('editVentaIndex').value;

    if (pIdx === "") return alert("Seleccione un producto");

    if (editIdx === "") {
        // --- NUEVA VENTA ---
        if (prods[pIdx].stock >= nuevaCant) {
            prods[pIdx].stock -= nuevaCant; // Descontar stock
            ventas.push({
                fecha: new Date().toLocaleString(),
                productoNom: prods[pIdx].nombre,
                productoIdx: pIdx,
                cantidad: nuevaCant
            });
        } else {
            return alert("Stock insuficiente para realizar la venta.");
        }
    } else {
        // --- MODIFICAR VENTA ---
        const vOriginal = ventas[editIdx];
        const pActual = prods[vOriginal.productoIdx];

        // 1. Devolver stock anterior
        pActual.stock = parseInt(pActual.stock) + parseInt(vOriginal.cantidad);

        // 2. Verificar si alcanza para la nueva cantidad
        if (pActual.stock >= nuevaCant) {
            pActual.stock -= nuevaCant;
            ventas[editIdx].cantidad = nuevaCant;
            ventas[editIdx].fecha = new Date().toLocaleString() + " (Modificado)";
            
            // Resetear interfaz
            document.getElementById('editVentaIndex').value = "";
            document.getElementById('btnVenta').className = "btn btn-success w-100";
            document.getElementById('btnVenta').innerHTML = '<i class="bi bi-cart-plus"></i> Vender';
            document.getElementById('selectProd').disabled = false;
        } else {
            // Revertir el stock si no alcanza
            pActual.stock -= vOriginal.cantidad;
            return alert("No hay suficiente stock para ajustar a esa cantidad.");
        }
    }

    VentaService.saveAll(ventas, prods);
    e.target.reset();
    renderVentas();
}

function prepararEdicionVenta(i) {
    const v = VentaService.getVentas()[i];
    document.getElementById('selectProd').value = v.productoIdx;
    document.getElementById('cantVenta').value = v.cantidad;
    document.getElementById('editVentaIndex').value = i;
    
    const btn = document.getElementById('btnVenta');
    btn.className = "btn btn-info text-white w-100";
    btn.innerHTML = '<i class="bi bi-arrow-repeat"></i> Actualizar Venta';
    
    // Bloqueamos el select para no cambiar el producto de una venta ya hecha (evita errores de stock)
    document.getElementById('selectProd').disabled = true;
}

function eliminarVenta(i) {
    if (confirm("¿Eliminar este registro? El stock se devolverá al producto.")) {
        let ventas = VentaService.getVentas();
        let prods = VentaService.getProds();
        const v = ventas[i];

        // Devolver stock si el producto existe
        if (prods[v.productoIdx]) {
            prods[v.productoIdx].stock = parseInt(prods[v.productoIdx].stock) + parseInt(v.cantidad);
        }

        ventas.splice(i, 1);
        VentaService.saveAll(ventas, prods);
        renderVentas();
    }
}