<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeclaracionCapituloSociedad extends Model
{
    protected $table = 'declaracion_capitales_sociedades';

    protected $fillable = [
        'declaracion_jurada_id',
        'denominacion',
        'ramo_actividad',
        'domicilio',
        'porcentaje_capital',
        'ultima_valuacion',
    ];

    public function declaracionJurada(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(DeclaracionJurada::class);
    }
}
