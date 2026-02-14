<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="mt-8">
    
    <h2 class="text-lg font-semibold mb-4">
        Lotes ingresados
    </h2>

@if($modo === 'almacen')
<form action="{{ route('maquila.enviar') }}" method="POST" id="formMaquila">
    @csrf
@endif

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

                    @if($modo === 'almacen')
                        <th class="p-3">Seleccionar</th>
                    @endif

                    @if($modo === 'control')
                        <th class="p-3">Eliminar</th>
                    @endif
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

                        {{-- COLUMNA AUTORIZACIÓN --}}
                        <td class="p-3">

                            @if($modo === 'control')

                                <form action="{{ route('lotes.cambiarAutorizacion', $lote->id) }}" 
                                    method="POST">
                                    @csrf
                                    @method('PATCH')

                                    @php
                                        $colorClasses = match($lote->autorizacion_entrada) {
                                            'autorizado' => 'bg-green-100 text-green-700 border-green-400',
                                            'pendiente' => 'bg-yellow-100 text-yellow-700 border-yellow-400',
                                            'declinado' => 'bg-red-100 text-red-700 border-red-400',
                                            default => 'bg-gray-100 text-gray-700 border-gray-300'
                                        };
                                    @endphp

                                    <select name="autorizacion_entrada"
                                            onchange="this.form.submit()"
                                            class="px-2 py-1 text-sm font-semibold rounded border {{ $colorClasses }}">
                                        <option value="pendiente" {{ $lote->autorizacion_entrada == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                        <option value="autorizado" {{ $lote->autorizacion_entrada == 'autorizado' ? 'selected' : '' }}>Autorizado</option>
                                        <option value="declinado" {{ $lote->autorizacion_entrada == 'declinado' ? 'selected' : '' }}>Declinado</option>
                                    </select>
                                </form>

                            @else

                                @php
                                    $badgeClasses = match($lote->autorizacion_entrada) {
                                        'autorizado' => 'bg-green-100 text-green-700',
                                        'pendiente' => 'bg-yellow-100 text-yellow-700',
                                        'declinado' => 'bg-red-100 text-red-700',
                                        default => 'bg-gray-100 text-gray-700'
                                    };
                                @endphp

                                <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $badgeClasses }}">
                                    {{ ucfirst($lote->autorizacion_entrada) }}
                                </span>

                            @endif

                        </td>
                        @if($modo === 'almacen')
                        <td class="p-3 text-center">
                            <input type="checkbox" 
                                name="lotesSeleccionados[]" 
                                value="{{ $lote->id }}"
                                class="checkbox-lote w-4 h-4">
                        </td>
                        @endif    

                        {{-- COLUMNA ELIMINAR SOLO EN CONTROL --}}
                        @if($modo === 'control')
                        <td class="p-3">
                            <button 
                                type="button"
                                data-id="{{ $lote->id }}"
                                class="btn-eliminar bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
                                Eliminar
                            </button>
                        </td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
        </table>
    </div>
</form>
<meta name="csrf-token" content="{{ csrf_token() }}">
@vite(['resources/css/app.css', 'resources/js/app.js'])
@if($modo === 'almacen')

    <div class="mt-4 flex justify-end">
        <button type="button"
            onclick="mostrarFormularioMaquila()"
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
            Enviar a Maquila
        </button>
    </div>

    <div id="contenedorMaquila" class="mt-6 hidden border rounded p-4 bg-gray-50">
    </div>

@endif






{{-- MODAL ELIMINAR --}}

    <div id="modalEliminar" 
        class="fixed inset-0 bg-stone-950/40 hidden items-center justify-center">

        <div class="bg-white rounded-lg p-6 w-96 shadow-lg">

            <h2 class="text-lg font-bold mb-4">Confirmar eliminación</h2>

            <p class="mb-6">¿Estás seguro que deseas eliminar este lote?</p>

            <div class="flex justify-end space-x-3">

                <button onclick="cerrarModal()" 
                    class="px-4 py-2 bg-gray-300 rounded">
                    Cancelar
                </button>

                <form id="formEliminar" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="submit"
                        class="px-4 py-2 bg-red-600 text-white rounded">
                        Sí, eliminar
                    </button>
                </form>

            </div>
        </div>
    </div>
</div>






