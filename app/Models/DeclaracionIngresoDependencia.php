<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeclaracionIngresoDependencia extends Model
{
    protected $table = 'declaracion_ingresos_dependencia';
    protected $fillable = [
        'declaracion_jurada_id',
        'cargo',
        'empleador',
        'monto',
    ];

    public function declaracionJurada(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(DeclaracionJurada::class);
    }
}
