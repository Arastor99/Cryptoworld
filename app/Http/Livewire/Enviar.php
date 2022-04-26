<?php

namespace App\Http\Livewire;
use App\Models\Cartera;
use App\Models\Direccion;
use App\Models\Crypto;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Enviar extends Component
{
    public $prueba;

    protected $rules = [
        'prueba' => 'required',
    ];

    public function render()
    {
        return view ('livewire.enviar', [
            'cryptos' => Crypto::all()
        ]);
    }
    public function updatedprueba($prueba){
            $this->prueba = Cartera::select('cantidad', 'crypto_id')
            ->join('direcciones', 'carteras.direccion_id', '=', 'direcciones.id')
            ->where('carteras.user_id', '=', Auth::user()->id)
            ->where('direcciones.crypto_id', '=', $prueba)->get();
    }
}
