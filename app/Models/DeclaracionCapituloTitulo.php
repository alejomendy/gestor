<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeclaracionCapituloTitulo extends Model
{
    protected $table = 'declaracion_capitales_titulos';

    protected $fillable = [
        'declaracion_jurada_id',
        'tipo',
        'entidad_emisora',
        'cantidad',
        'valor_unitario_cotiz',
        'valor_total',
    ];

    public function declaracionJurada(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(DeclaracionJurada::class);
    }
}
