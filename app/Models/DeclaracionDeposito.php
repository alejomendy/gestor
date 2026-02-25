<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeclaracionDeposito extends Model
{
    protected $table = 'declaracion_depositos';
    protected $fillable = [
        'declaracion_jurada_id',
        'tipo',
        'entidad',
        'localidad_pais',
        'monto_pesos',
        'monto_moneda_extranjera',
    ];

    public function declaracionJurada(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(DeclaracionJurada::class);
    }
}
