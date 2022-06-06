<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fiat extends Model
{
    use HasFactory;

    protected $table = 'fiats';
    public function cartera_fiats()
    {
        return $this->hasMany(CarteraFiat::class);
    }
}
