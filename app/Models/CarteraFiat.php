<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarteraFiat extends Model
{
    use HasFactory;

    protected $table = 'cartera_fiats';

    public $timestamps = false;

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function fiats()
    {
        return $this->hasMany(Fiat::class);
    }

    protected $fillable = [
        'cantidad',
        'user_id',
        'fiat_id',
    ];
}
