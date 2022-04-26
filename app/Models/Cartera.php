<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cartera extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function direcciones()
    {
        return $this->hasMany(Direccion::class);
    }

    protected $fillable = [
        'nombre',
        'user_id',
        'direccion_id',
    ];
}
