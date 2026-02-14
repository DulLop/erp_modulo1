<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MovimientoMaquila;
use App\Models\Lote;
use Illuminate\Support\Facades\DB;

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

        return DB::transaction(function () use ($request) {

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
                'autorizacion_salida' => 'pendiente' // opcional pero recomendable
            ]);

            // Actualizar lote
            $lote->metros_restantes -= $request->metros_enviados;
            $lote->ubicacion = 'maquila';
            $lote->save();

            return response()->json($movimiento, 201);
        });
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

    public function enviarLotes(Request $request)
        {
            $request->validate([
                'lote_id' => 'required|array',
                'maquilador' => 'required|array',
                'lotes_enviados' => 'required|array',
                'fecha_salida' => 'required|array',
            ]);

            DB::transaction(function () use ($request) {

                foreach ($request->lote_id as $index => $loteId) {

                    $lote = Lote::findOrFail($loteId);

                    $metrosEnviados = $request->lotes_enviados[$index];

                    // ⚠ Validar que no envíen más metros de los disponibles
                    if ($metrosEnviados > $lote->metros_iniciales) {
                        throw new \Exception("No hay suficientes metros en el lote {$lote->lote}");
                    }

                    // 1️⃣ Crear movimiento
                    MovimientoMaquila::create([
                        'lote_id' => $loteId,
                        'maquilador' => $request->maquilador[$index],
                        'metros_enviados' => $metrosEnviados,
                        'fecha_salida' => $request->fecha_salida[$index],
                        'estatus_salida' => 'enviado'
                    ]);

                    // 2️⃣ Restar metros al lote
                    $lote->metros_iniciales -= $metrosEnviados;
                    $lote->save();
                }
            });

            return back()->with('success', 'Envío a maquila registrado correctamente.');
        }




}
