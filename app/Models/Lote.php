<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\MovimientoMaquila;


class Lote extends Model
{
    protected $fillable = [
        'lote',
        'proveedor',
        'tela',
        'metros_iniciales',
        'metros_restantes',
        'caracteristicas',
        'fecha_entrada',
        'autorizacion_entrada',
        'ubicacion'
    ];

    protected $casts = [
        'fecha_entrada' => 'date'
    ];

    public function movimientosMaquila()
{
    return $this->hasMany(MovimientoMaquila::class);
}
}



