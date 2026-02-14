@extends('layouts.app')

@section('title', 'Gestion de Almacen - Telas')

@section('content')

    <h1 class="text-2xl font-bold mb-6">
        Telas · Gestión de Almacén
    </h1>

    <!-- Tabs -->
    <div class="border-b border-b-gray-300 mb-6 flex space-x-8">

        <a href="{{ route('materiaprima.telas.almacen', ['tab' => 'stock']) }}"
           class="pb-2
           {{ $tab === 'stock' ? 'border-b-2 border-blue-600 font-semibold text-blue-600' : 'text-gray-500' }}">
            Stock
        </a>

        <a href="{{ route('materiaprima.telas.almacen', ['tab' => 'entradas']) }}"
           class="pb-2
           {{ $tab === 'entradas' ? 'border-b-2 border-blue-600 font-semibold text-blue-600' : 'text-gray-500' }}">
            Entradas a Planta
        </a>

        <a href="{{ route('materiaprima.telas.almacen', ['tab' => 'maquila']) }}"
           class="pb-2
           {{ $tab === 'maquila' ? 'border-b-2 border-blue-600 font-semibold text-blue-600' : 'text-gray-500' }}">
            Maquila
        </a>

        <a href="{{ route('materiaprima.telas.almacen', ['tab' => 'llegadas']) }}"
           class="pb-2
           {{ $tab === 'llegadas' ? 'border-b-2 border-blue-600 font-semibold text-blue-600' : 'text-gray-500' }}">
            Llegadas
        </a>

    </div>

    <!-- Contenido dinámico por tab -->
    <div class="bg-white rounded shadow p-3">

        @if($tab === 'stock')
            <p>Vista de Stock (aquí irá la tabla de inventario).</p>
        @endif

        @if($tab === 'entradas')
            @include ('materiaprima.telas.partials._tabla_lotes', [
                'modo' => 'almacen'
            ])
        @endif

        @if($tab === 'maquila')
            <p>Vista de Maquila.</p>
        @endif

        @if($tab === 'llegadas')
            <p>Vista de Llegadas.</p>
        @endif

    </div>

@endsection