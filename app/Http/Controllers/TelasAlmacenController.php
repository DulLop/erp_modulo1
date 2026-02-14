<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lote;
use App\Models\MovimientoMaquila;

class TelasAlmacenController extends Controller
{
    public function index(Request $request)
    {
        $tab = $request->query('tab', 'stock');

        $lotes = Lote::orderBy('created_at', 'desc')->get();

        return view('materiaprima.telas.almacen.index', compact('tab', 'lotes'));
    }

}
