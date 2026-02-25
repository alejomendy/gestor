<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeclaracionJurada extends Model
{
    protected $table = 'declaraciones_juradas';
    protected $fillable = [
        'worker_id',
        'legajo',
        'estado_civil',
        'ci_numero',
        'ci_expedida_por',
        'profesion',
        'domicilio',
        'lugar_fecha',
        'fecha_declaracion',
    ];

    protected $casts = [
        'fecha_declaracion' => 'date',
    ];

    public function worker(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Worker::class);
    }

    public function familiares(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(DeclaracionFamiliar::class);
    }

    public function bienesInmuebles(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(DeclaracionBienInmueble::class);
    }

    public function bienesMuebles(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(DeclaracionBienMueble::class);
    }

    public function otrosBienes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(DeclaracionOtroBien::class);
    }

    public function capitalesTitulos(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(DeclaracionCapituloTitulo::class);
    }

    public function capitalesSociedades(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(DeclaracionCapituloSociedad::class);
    }

    public function depositos(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(DeclaracionDeposito::class);
    }

    public function creditos(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(DeclaracionCredito::class);
    }

    public function deudas(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(DeclaracionDeuda::class);
    }

    public function ingresosDependencia(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(DeclaracionIngresoDependencia::class);
    }

    public function ingresosIndependiente(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(DeclaracionIngresoIndependiente::class);
    }

    public function ingresosPrevisional(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(DeclaracionIngresoPrevisional::class);
    }
}
