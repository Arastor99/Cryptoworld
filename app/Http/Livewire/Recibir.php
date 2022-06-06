<?php

namespace App\Http\Livewire;
use App\Models\Cartera;
use App\Models\Direccion;
use App\Models\Crypto;
use Illuminate\Support\Facades\Auth;

use Livewire\Component;

class Recibir extends Component
{

    public $prueba;
    protected $rules = [
        'prueba' => 'required',
    ];
    public function render()
    {
        return view ('livewire.recibir', [
        'cryptos' => Crypto::all()
    ]);
    }
    public function updatedprueba($prueba){
       $this->prueba = Direccion::where('user_id', Auth::user()->id)
       ->where('crypto_id', $prueba)->get();
    }
}
