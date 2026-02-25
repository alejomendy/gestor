<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeclaracionCredito extends Model
{
    protected $table = 'declaracion_creditos';
    protected $fillable = [
        'declaracion_jurada_id',
        'apellido_nombre_razon',
        'identificacion_bien',
        'nro_inscripcion',
        'monto_credito',
    ];

    public function declaracionJurada(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(DeclaracionJurada::class);
    }
}
