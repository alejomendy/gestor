<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    protected $fillable = [
        'name',
        'last_name',
        'dni',
        'slug',
        'status',
        'id_front_path',
        'id_back_path',
        'contract_path',
        'phone',
        'email',
        'address',
        'city',
        'birth_date',
        'hire_date',
        'photo_path',
    ];

    public function attendances(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Attendance::class);
    }
}
