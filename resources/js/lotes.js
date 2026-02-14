document.addEventListener('DOMContentLoaded', () => {

    // Delegación de evento para botón eliminar
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('btn-eliminar')) {
            const id = e.target.dataset.id;
            abrirModal(id);
        }
    });

});

// Hacemos globales las funciones que se llaman desde Blade
window.abrirModal = function (id) {
    const modal = document.getElementById('modalEliminar');
    const form = document.getElementById('formEliminar');

    if (!modal || !form) return;

    form.action = `/materiaprima/lotes/${id}`;
    modal.classList.remove('hidden');
    modal.classList.add('flex');
};

window.cerrarModal = function () {
    const modal = document.getElementById('modalEliminar');
    if (!modal) return;

    modal.classList.add('hidden');
    modal.classList.remove('flex');
};

window.mostrarFormularioMaquila = function () {

    const checkboxes = document.querySelectorAll('.checkbox-lote:checked');

    if (checkboxes.length === 0) {
        alert('Selecciona al menos un lote.');
        return;
    }

    const contenedor = document.getElementById('contenedorMaquila');
    if (!contenedor) return;

    contenedor.innerHTML = '';

    const hoy = new Date().toISOString().split('T')[0];

    let formHTML = `
        <form method="POST" action="/maquila/enviar">
            <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').content}">
    `;

    checkboxes.forEach(cb => {

        cb.disabled = true;

        const fila = cb.closest('tr');
        const celdas = fila.querySelectorAll('td');

        const lote = celdas[0].innerText;
        const proveedor = celdas[1].innerText;
        const tela = celdas[2].innerText;

        formHTML += `
            <div class="mb-6 border-b pb-4">

                <h3 class="font-semibold text-lg mb-2">
                    Lote: ${lote} | ${tela}
                </h3>

                <p class="text-sm text-gray-600 mb-3">
                    Proveedor: ${proveedor}
                </p>

                <div class="grid grid-cols-3 gap-4">

                    <div>
                        <label class="block text-sm font-medium mb-1">
                            Maquilador
                        </label>
                        <select name="maquilador" class="w-full border rounded px-2 py-1" required>
                            <option value="Norte">Norte</option>
                            <option value="Sur">Sur</option>
                            <option value="Este">Este</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">
                            Metros enviados
                        </label>
                        <input type="number"
                               name="metros_enviados"
                               class="w-full border rounded px-2 py-1"
                               min="1"
                               required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">
                            Fecha de salida
                        </label>
                        <input type="date"
                               name="fecha_salida"
                               class="w-full border rounded px-2 py-1"
                               min="${hoy}"
                               required>
                    </div>

                </div>

                <input type="hidden" name="lote_id" value="${cb.value}">

            </div>
        `;
    });

    formHTML += `
            <div class="mt-4">
                <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded">
                    Confirmar
                </button>
            </div>
        </form>
    `;

    contenedor.innerHTML = formHTML;
    contenedor.classList.remove('hidden');
};
