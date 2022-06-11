<?php

namespace App\Http\Livewire;

use App\Models\Crypto;
use Livewire\Component;
use App\Http\Controllers\PreciosController;
use App\Models\Cartera;
use Illuminate\Support\Facades\Auth;

class Enviar extends Component
{
    public $cripto;
    public $disponible;
    public $nombre;

    public function render()
    {
        return view('livewire.enviar', [
            'cryptos' => Crypto::all()
        ]);
    }




    public function updatedcripto()
    {

        $this->disponible = Cartera::select('cantidad')
            ->join('direcciones', 'carteras.direccion_id', '=', 'direcciones.id')
            ->join('cryptos', 'cryptos.id', '=', 'direcciones.crypto_id')
            ->where('carteras.user_id', '=', Auth::user()->id)
            ->where('cryptos.id', '=', $this->cripto)
            ->first();
        $this->disponible = $this->disponible->cantidad;


        if (!empty($this->cripto)) {
            $this->nombre = Crypto::select('abr')->where('id', '=', $this->cripto)->get();
            $this->nombre = $this->nombre[0]->abr;
        }
    }
}
