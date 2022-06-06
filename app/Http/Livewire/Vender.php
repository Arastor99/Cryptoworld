<?php

namespace App\Http\Livewire;
use App\Models\Crypto;
use Livewire\Component;
use App\Http\Controllers\PreciosController;
use App\Models\Cartera;
use App\Models\Fiat;
use Illuminate\Support\Facades\Auth;

class Vender extends Component
{
    public $crypto;
    public $crypto1;
    public $fiat;
    public $fiat1;
    public $cantidad;
    public $precio;
    public $nombre1;
    public $nombre2;
    public $recibir;
    public function render()
    {
        return view ('livewire.vender', [
            'cryptos' => Crypto::all(),
            'fiats' => Fiat::all(),

        ]);
    }

    public function updatedcrypto($crypto_id){
        $this->nombre1 = Crypto::select('abr')->where('id','=', $crypto_id)->get();
        $binance = new PreciosController();
        $this->precio = $binance->precio($this->nombre1[0]->abr . 'EUR');
    }
    public function updatedfiat($crypto_id, $nombre2){
        $this->nombre2 = Crypto::select('abr')->where('id','=', $crypto_id)->get();
    }

    public function updatedcantidad(){
        $this->recibir = (float) $this->cantidad * (float) $this->precio['price'];
    }

}
