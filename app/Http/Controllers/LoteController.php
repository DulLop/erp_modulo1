<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lote;


class LoteController extends Controller
{
    public function index()
    {
        return Lote::orderBy('created_at', 'desc')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'lote' => 'required|unique:lotes,lote',
            'proveedor' => 'required',
            'tela' => 'required',
            'metros_iniciales' => 'required|integer|min:1',
            'fecha_entrada' => 'required|date',

        ]);

        $lote = Lote::create([
            'lote' => $request->lote,
            'proveedor' => $request->proveedor,
            'tela' => $request->tela,
            'metros_iniciales' => $request->metros_iniciales,
            'metros_restantes' => $request->metros_iniciales, // 👈 aquí
            'caracteristicas' => $request->caracteristicas,
            'fecha_entrada' => $request->fecha_entrada,
        ]);

        return redirect()
        ->route('materiaprima.control', ['tab' => 'entradas'])
        ->with('success', 'Lote registrado correctamente');

    }

    public function update(Request $request, Lote $lote)
    {
        $lote->update($request->only([
            'proveedor',
            'tela',
            'caracteristicas',
            'fecha_entrada'
        ]));

        return response()->json($lote);
    }


    //Estados interactivos
    public function cambiarAutorizacion(Request $request, Lote $lote)
    {
        $request->validate([
            'autorizacion_entrada' => 'required|in:pendiente,autorizado,declinado'
        ]);

        $lote->autorizacion_entrada = $request->autorizacion_entrada;
        $lote->save();

        return redirect()->route('materiaprima.control', ['tab' => 'entradas'])
                     ->with('success', 'Estado actualizado');
    }


    //Cambiar ubicación
    public function cambiarUbicacion(Request $request, Lote $lote)
    {
        $request->validate([
            'ubicacion' => 'required|in:almacen,maquila,terminado'
        ]);

        $lote->ubicacion = $request->ubicacion;
        $lote->save();

        return response()->json($lote);
    }

     public function control(Request $request)
    {
        $tab = $request->query('tab', 'entradas');
    
        $lotes = Lote::orderBy('created_at', 'desc')->get();

        return view('materiaprima.telas.control', compact('lotes', 'tab'));
    }

    //Eliminar Lote

    public function destroy($id)
    {
        $lote = \App\Models\Lote::findOrFail($id);
        $lote->delete();

        return back()->with('success', 'Lote eliminado correctamente');
    }


}

