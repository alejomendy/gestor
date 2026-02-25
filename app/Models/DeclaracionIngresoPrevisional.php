<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeclaracionIngresoPrevisional extends Model
{
    protected $table = 'declaracion_ingresos_previsional';
    protected $fillable = [
        'declaracion_jurada_id',
        'tipo_beneficio',
        'caja_prevision',
        'nro_beneficiario',
        'monto',
    ];

    public function declaracionJurada(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(DeclaracionJurada::class);
    }
}
