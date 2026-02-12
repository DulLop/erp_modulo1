<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MovimientoMaquila extends Model
{
    protected $table = 'movimientos_maquila';

    protected $fillable = [
        'lote_id',
        'maquilador',
        'metros_enviados',
        'fecha_salida',
        'autorizacion_salida',
        'fecha_llegada',
        'piezas',
        'producto_final',
        'autorizacion_llegada'
    ];

    protected $casts = [
        'fecha_salida' => 'date',
        'fecha_llegada' => 'date'
    ];

    public function lote()
    {
        return $this->belongsTo(Lote::class);
    }
}

