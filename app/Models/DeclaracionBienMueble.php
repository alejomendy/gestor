<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeclaracionBienMueble extends Model
{
    protected $table = 'declaracion_bienes_muebles';
    protected $fillable = [
        'declaracion_jurada_id',
        'tipo',
        'descripcion',
        'nro_patente_matricula',
        'porcentaje_propiedad',
        'fecha_ingreso',
        'valuacion_actualizada',
    ];

    protected $casts = [
        'fecha_ingreso' => 'date',
    ];

    public function declaracionJurada(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(DeclaracionJurada::class);
    }
}
