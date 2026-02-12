<div class="mb-8">

    <h2 class="text-lg font-semibold mb-4">
        Registrar Entrada de Lote
    </h2>

    <form action="{{ route('lotes.store') }}" method="POST" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            {{-- Lote --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Lote
                </label>
                <input type="text" name="lote"
                       class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200"
                       required>
            </div>

            {{-- Proveedor --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Proveedor
                </label>
                <select name="proveedor"
                    class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200"
                    required>
                    <option value="">Seleccionar proveedor</option>
                    <option value="A">Proveedor A</option>
                    <option value="B">Proveedor B</option>
                    <option value="C">Proveedor C</option>
                </select>

            </div>

            {{-- Tela --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Tela
                </label>
                <select name="tela"
                    class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200"
                    required>
                    <option value="">Seleccionar tela</option>
                    <option value="Dubai">Dubai</option>
                    <option value="Satín Liso">Satín Liso</option>
                    <option value="Percal Estándar">Percal Estándar</option>
                </select>

            </div>

            {{-- Metros Iniciales --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Metros Iniciales
                </label>
                <input type="number" name="metros_iniciales"
                       class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200"
                       min="1"
                       required>
            </div>

            {{-- Características --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Características
                </label>
                <input type="text" name="caracteristicas"
                       class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200">
            </div>

            {{-- Fecha Entrada --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Fecha de Entrada
                </label>
                <input type="date" name="fecha_entrada"
                       class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200"
                       required>
            </div>

        </div>

        {{-- Botón --}}
        <div class="flex justify-end">
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded shadow">
                Ingresar
            </button>
        </div>

    </form>

</div>
