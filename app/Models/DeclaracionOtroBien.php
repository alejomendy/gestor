<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeclaracionOtroBien extends Model
{
    protected $table = 'declaracion_otros_bienes';
    protected $fillable = [
        'declaracion_jurada_id',
        'detalle',
        'valuacion_actualizada',
    ];

    public function declaracionJurada(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(DeclaracionJurada::class);
    }
}
