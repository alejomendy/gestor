<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeclaracionFamiliar extends Model
{
    protected $table = 'declaracion_familiares';
    protected $fillable = [
        'declaracion_jurada_id',
        'apellido_nombres',
        'parentesco',
        'doc_tipo',
        'doc_numero',
    ];

    public function declaracionJurada(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(DeclaracionJurada::class);
    }
}
