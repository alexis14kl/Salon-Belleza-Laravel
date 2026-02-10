<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Customer extends Model
{
    protected $fillable = [
        'nombre',
        'apellido',
        'telefono',
        'email',
        'direccion',
        'notas',
        'role_id',
    ];

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function scopeClientes(Builder $query): Builder
    {
        return $query->where('role_id', 2);
    }

    public function scopeProspectos(Builder $query): Builder
    {
        return $query->where('role_id', 3);
    }
}
