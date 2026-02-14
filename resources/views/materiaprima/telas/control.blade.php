@extends('layouts.app')

@section('title', 'Control de Entradas y Salidas - Telas')

@section('content')

    <h1 class="text-2xl font-bold mb-6">
        Telas · Control de Entradas y Salidas
    </h1>

    {{-- MENÚ DE PESTAÑAS --}}
<nav class="border-b border-b-gray-300 flex space-x-8">

    {{-- ENTRADAS --}}
    <a href="{{ route('materiaprima.control', ['tab' => 'entradas']) }}"
       class="{{ $tab === 'entradas' 
            ? 'pb-2 border-b-2 border-blue-500 font-semibold text-blue-600' 
            : 'pb-2 border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
        Entradas a Planta
    </a>

    {{-- SALIDAS --}}
    <a href="{{ route('materiaprima.control', ['tab' => 'salidas']) }}"
       class="{{ $tab === 'salidas' 
            ? 'pb-2 border-b-2 border-blue-500 font-semibold text-blue-600' 
            : 'pb-2 border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
        Salidas a Maquila
    </a>

    {{-- LLEGADAS --}}
    <a href="{{ route('materiaprima.control', ['tab' => 'llegadas']) }}"
       class="{{ $tab === 'llegadas' 
            ? 'pb-2 border-b-2 border-blue-500 font-semibold text-blue-600' 
            : 'pb-2 border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
        Llegada a Planta
    </a>

</nav>

    {{-- CONTENIDO DE LA PESTAÑA --}}
    <div class="bg-white rounded shadow p-6">
        @if($tab === 'entradas')

            @if(session('success'))
                <div class="bg-green-100 text-green-700 px-4 py-3 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif

            @include('materiaprima.telas.partials._form_entradasaplanta')

            @if($lotes->count() > 0)
                @include('materiaprima.telas.partials._tabla_lotes', ['modo' => 'control'])
            @endif

        @endif

        @if($tab === 'salidas')
            <p>Contenido de salidas aquí</p>
        @endif

        @if($tab === 'llegadas')
            <p>Contenido de llegadas aquí</p>
        @endif

    </div>

@endsection
