<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MovimientoMaquila;
use App\Models\Lote;

class MovimientoMaquilaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'lote_id' => 'required|exists:lotes,id',
            'maquilador' => 'required',
            'metros_enviados' => 'required|integer|min:1',
            'fecha_salida' => 'required|date',
        ]);

        $lote = Lote::findOrFail($request->lote_id);

        // Validación de negocio
        if ($request->metros_enviados > $lote->metros_restantes) {
            return response()->json([
                'error' => 'No hay suficientes metros disponibles en el lote'
            ], 422);
        }

        // Crear movimiento
        $movimiento = MovimientoMaquila::create([
            'lote_id' => $lote->id,
            'maquilador' => $request->maquilador,
            'metros_enviados' => $request->metros_enviados,
            'fecha_salida' => $request->fecha_salida,
        ]);

        // Actualizar lote
        $lote->metros_restantes -= $request->metros_enviados;
        $lote->ubicacion = 'maquila';
        $lote->save();

        return response()->json($movimiento, 201);
    }


        //Registrar llegada de maquila
        public function registrarLlegada(Request $request, MovimientoMaquila $movimiento)
        {
            $request->validate([
                'fecha_llegada' => 'required|date',
                'piezas' => 'required|integer|min:1',
                'producto_final' => 'required',
                'autorizacion_llegada' => 'required|in:pendiente,autorizado,declinado'
            ]);

            $movimiento->update([
                'fecha_llegada' => $request->fecha_llegada,
                'piezas' => $request->piezas,
                'producto_final' => $request->producto_final,
                'autorizacion_llegada' => $request->autorizacion_llegada
            ]);

            return response()->json($movimiento);
        }


        //Cambiar autorización de salida
        public function cambiarAutorizacionSalida(Request $request, MovimientoMaquila $movimiento)
        {
            $request->validate([
                'autorizacion_salida' => 'required|in:pendiente,autorizado,declinado'
            ]);

            $movimiento->autorizacion_salida = $request->autorizacion_salida;
            $movimiento->save();

            return response()->json($movimiento);
        }


}
