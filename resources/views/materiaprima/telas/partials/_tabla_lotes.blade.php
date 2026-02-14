<div class="mt-8">
    
    <h2 class="text-lg font-semibold mb-4">
        Lotes ingresados
    </h2>

    
    <div class="max-h-96 overflow-y-auto border rounded">
        <table class="min-w-full text-sm text-left">
            
            <thead class="bg-slate-200 sticky top-0">
                <tr>
                    <th class="p-3">Lote</th>
                    <th class="p-3">Proveedor</th>
                    <th class="p-3">Tela</th>
                    <th class="p-3">Metros Iniciales</th>
                    <th class="p-3">Características</th>
                    <th class="p-3">Fecha de Entrada</th>
                    <th class="p-3">Autorización de Entrada</th>
                    <th class="p-3 text-center">Eliminar</th>
                </tr>
            </thead>

            <tbody>
                @foreach($lotes as $lote)
                    <tr class="border-t hover:bg-gray-50">
                        
                        <td class="p-3">{{ $lote->lote }}</td>
                        <td class="p-3">{{ $lote->proveedor }}</td>
                        <td class="p-3">{{ $lote->tela }}</td>
                        <td class="p-3">{{ $lote->metros_iniciales }}</td>
                        <td class="p-3">{{ $lote->caracteristicas }}</td>
                        <td class="p-3">{{ $lote->created_at->format('d/m/Y') }}</td>

                        <td class="p-3">
                            <select
                                class="js-autorizacion-select border rounded px-2 py-1 text-sm"
                                data-lote-id="{{ $lote->id }}"
                            >
                                <option value="pendiente" 
                                    {{ $lote->autorizacion_entrada == 'pendiente' ? 'selected' : '' }}>
                                    Pendiente
                                </option>
                            
                                <option value="autorizado"
                                    {{ $lote->autorizacion_entrada == 'autorizado' ? 'selected' : '' }}>
                                    Autorizado
                                </option>

                                <option value="declinado"
                                    {{ $lote->autorizacion_entrada == 'declinado' ? 'selected' : '' }}>
                                    Declinado
                                </option>
                            </select>
                        </td>

                        <td class="p-3 text-center">
                            <button class="text-red-600 hover:text-red-800">
                                🗑
                            </button>
                        </td>

                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>
    
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const estados = {
        pendiente: {
            claseBg: 'bg-yellow-100',
            claseTexto: 'text-yellow-600',
        },
        autorizado: {
            claseBg: 'bg-green-100',
            claseTexto: 'text-green-700',
        },
        declinado: {
            claseBg: 'bg-red-100',
            claseTexto: 'text-red-700',
        },
    };

    const actualizarEstilo = (select, estado) => {
        Object.values(estados).forEach(({ claseBg, claseTexto }) => {
            select.classList.remove(claseBg, claseTexto);
        });

        const clasesEstado = estados[estado] ?? estados.pendiente;
        select.classList.add(clasesEstado.claseBg, clasesEstado.claseTexto);
    };

    document.querySelectorAll('.js-autorizacion-select').forEach((select) => {
        actualizarEstilo(select, select.value);

        select.addEventListener('change', async (event) => {
            const nuevoEstado = event.target.value;
            const estadoPrevio = event.target.dataset.estadoPrevio ?? 'pendiente';
            const loteId = event.target.dataset.loteId;

            event.target.disabled = true;

            try {
                const respuesta = await fetch(`/materiaprima/lotes/${loteId}/autorizacion`, {
                    method: 'PATCH',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({ autorizacion_entrada: nuevoEstado }),
                });

                if (!respuesta.ok) {
                    throw new Error('No se pudo guardar el cambio de autorización.');
                }

                event.target.dataset.estadoPrevio = nuevoEstado;
                actualizarEstilo(event.target, nuevoEstado);
            } catch (error) {
                event.target.value = estadoPrevio;
                actualizarEstilo(event.target, estadoPrevio);
                alert(error.message);
            } finally {
                event.target.disabled = false;
            }
        });

        select.dataset.estadoPrevio = select.value;
    });
});
</script>
