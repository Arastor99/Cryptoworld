<?php

namespace App\Http\Livewire;
use App\Models\Crypto;
use Livewire\Component;
use App\Http\Controllers\PreciosController;
use App\Models\Cartera;
use Illuminate\Support\Facades\Auth;

class Convertir extends Component
{
    public $crypto1;
    public $crypto2;
    public $cantidad;
    public $precio1;
    public $precio2;
    public $nombre1;
    public $nombre2;
    public $recibir;
    public function render()
    {
        return view ('livewire.convertir', [
            'cryptos' => Crypto::all()
        ]);
    }

    public function updatedcrypto1($crypto_id, $nombre1){
        $this->nombre1 = Crypto::select('abr')->where('id','=', $crypto_id)->get();
        $binance = new PreciosController();
        $this->precio1 = $binance->precio($this->nombre1[0]->abr . 'EUR');
    }
    public function updatedcrypto2($crypto_id, $nombre2){
        $this->nombre2 = Crypto::select('abr')->where('id','=', $crypto_id)->get();
        $binance = new PreciosController();
        $this->precio2 = $binance->precio($this->nombre2[0]->abr . 'EUR');
    }

    public function updatedcantidad(){
        $this->recibir = ((float) $this->cantidad * (float) $this->precio1['price']) / (float) $this->precio2['price'];
    }

}
