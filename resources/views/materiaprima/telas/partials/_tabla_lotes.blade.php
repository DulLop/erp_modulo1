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
                            <select class="border bg-yellow-100 rounded px-2 py-1 text-sm text-yellow-500">
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

