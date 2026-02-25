<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeclaracionBienInmueble extends Model
{
    protected $table = 'declaracion_bienes_inmuebles';
    protected $fillable = [
        'declaracion_jurada_id',
        'tipo',
        'ubicacion',
        'inscripcion_catastral',
        'porcentaje_propiedad',
        'fecha_ingreso',
        'valuacion_fiscal_importe',
        'valuacion_fiscal_anio',
    ];

    protected $casts = [
        'fecha_ingreso' => 'date',
    ];

    public function declaracionJurada(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(DeclaracionJurada::class);
    }
}
