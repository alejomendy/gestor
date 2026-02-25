<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeclaracionIngresoIndependiente extends Model
{
    protected $table = 'declaracion_ingresos_independiente';
    protected $fillable = [
        'declaracion_jurada_id',
        'actividad',
        'empresa_razon_social',
        'monto',
    ];

    public function declaracionJurada(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(DeclaracionJurada::class);
    }
}
