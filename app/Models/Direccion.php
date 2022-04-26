<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    use HasFactory;

    public function cartera()
    {
        return $this->belongsTo(Cartera::class);
    }
    public function crypto()
    {
        return $this->belongsTo(Crypto::class);
    }

    protected $table = 'direcciones';

    protected $fillable = [
        'direccion',
        'crypto_id',
        'user_id',
    ];
}
