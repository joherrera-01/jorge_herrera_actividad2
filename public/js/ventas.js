// Capa de Datos (Persistencia en LocalStorage)
const VentaService = {
    getVentas: () => JSON.parse(localStorage.getItem('ventas')) || [],
    getProds: () => JSON.parse(localStorage.getItem('productos')) || [],
    saveAll: (ventas, productos) => {
        localStorage.setItem('ventas', JSON.stringify(ventas));
        localStorage.setItem('productos', JSON.stringify(productos));
    }
};

// Función para mostrar mensajes de retroalimentación
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

    setTimeout(() => {
        const alertElement = wrapper.querySelector('.alert');
        if (alertElement) {
            const bsAlert = new bootstrap.Alert(alertElement);
            bsAlert.close();
        }
    }, 3000);
}

// Función para renderizar tabla y select de productos
function renderVentas() {
    const ventas = VentaService.getVentas();
    const prods = VentaService.getProds();
    
    const select = document.getElementById('selectProd');
    if (select) {
        select.innerHTML = '<option value="">Seleccione un producto...</option>';
        prods.forEach((p, i) => {
            select.innerHTML += `<option value="${i}">${p.nombre} (Stock: ${p.stock})</option>`;
        });
    }

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
                        <button class="btn btn-info btn-sm text-white me-1" 
                                onclick="prepararEdicionVenta(${i})"
                                data-tooltip="Editar Venta">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button class="btn btn-danger btn-sm" 
                                onclick="eliminarVenta(${i})"
                                data-tooltip="Anular Venta">
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
            prods[pIdx].stock -= nuevaCant;
            ventas.push({
                fecha: new Date().toLocaleString(),
                productoNom: prods[pIdx].nombre,
                productoIdx: pIdx,
                cantidad: nuevaCant
            });
            mostrarMensaje("¡Venta realizada con éxito!");
        } else {
            return alert("Stock insuficiente para realizar la venta.");
        }
    } else {
        // --- MODIFICAR VENTA ---
        const vOriginal = ventas[editIdx];
        const pActual = prods[vOriginal.productoIdx];

        pActual.stock = parseInt(pActual.stock) + parseInt(vOriginal.cantidad);

        if (pActual.stock >= nuevaCant) {
            pActual.stock -= nuevaCant;
            ventas[editIdx].cantidad = nuevaCant;
            ventas[editIdx].fecha = new Date().toLocaleString() + " (Modificado)";
            
            document.getElementById('editVentaIndex').value = "";
            document.getElementById('btnVenta').className = "btn btn-success w-100";
            document.getElementById('btnVenta').innerHTML = '<i class="bi bi-cart-plus"></i> Vender';
            document.getElementById('selectProd').disabled = false;
            
            mostrarMensaje("Registro de venta actualizado", "info");
        } else {
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
    
    document.getElementById('selectProd').disabled = true;
}

function eliminarVenta(i) {
    if (confirm("¿Eliminar este registro? El stock se devolverá al producto.")) {
        let ventas = VentaService.getVentas();
        let prods = VentaService.getProds();
        const v = ventas[i];

        if (prods[v.productoIdx]) {
            prods[v.productoIdx].stock = parseInt(prods[v.productoIdx].stock) + parseInt(v.cantidad);
        }

        ventas.splice(i, 1);
        VentaService.saveAll(ventas, prods);
        renderVentas();
        mostrarMensaje("Venta anulada y stock devuelto", "danger");
    }
}