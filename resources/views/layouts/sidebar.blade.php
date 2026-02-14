<div class="p-4 text-lg font-semibold border-b border-gray-700">
    Texfar
</div>

<nav class="p-4 space-y-2">

    {{-- Inventario de Materia Prima --}}
    <details class="group">
        <summary class="cursor-pointer flex justify-between items-center p-2 rounded hover:bg-gray-800">
            <span>Inventario de Materia Prima</span>
            <span class="group-open:rotate-180 transition-transform">⌄</span>
        </summary>

        <div class="ml-4 mt-2 space-y-1">

            {{-- Tela --}}
            <details class="group">
                <summary class="cursor-pointer flex justify-between items-center p-2 rounded hover:bg-gray-800">
                    <span>Tela</span>
                    <span class="group-open:rotate-180 transition-transform">⌄</span>
                </summary>

                <div class="ml-4 mt-2 space-y-1 text-sm">

                    <a href="{{ route('materiaprima.control', ['tab' => 'entradas']) }}"
                        class="block p-2 rounded
                        {{ request()->routeIs('materiaprima.control') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">
                            Control de Entradas y Salidas
                    </a>

                    <a href="{{ route('materiaprima.telas.almacen') }}"
                        class="block p-2 rounded hover:bg-gray-700">
                            Gestión de Almacén
                    </a>

                </div>
            </details>

        </div>
    </details>

</nav>
