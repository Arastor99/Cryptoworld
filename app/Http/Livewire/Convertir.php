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

    protected $rules = [
        'crypto1' => 'required',
        'crypto2' => 'required',
        'cantidad' => 'required',
        'precio1' => 'required',
        'precio2' => 'required',
        'nombre1' => 'required',
        'nombre2' => 'required',
        'recibir' => 'required',
    ];
    public function render()
    {
        return view ('livewire.convertir', [
            'cryptos' => Crypto::all()
        ]);
    }

    public function updatedcrypto1($crypto_id){
        $this->crypto = Crypto::select('abr')->where('id','=', $crypto_id)->get();
        $binance = new PreciosController();
        $this->precio1 = $binance->precio($this->crypto[0]->abr . 'EUR');
        $this->nombre1 = Crypto::select('abr')->where('id','=', $crypto_id)->get();
    }
    public function updatedcrypto2($crypto_id){
        $this->crypto = Crypto::select('abr')->where('id','=', $crypto_id)->get();
        $binance = new PreciosController();
        $this->precio2 = $binance->precio($this->crypto[0]->abr . 'EUR');
    }

    public function updatedcantidad($crypto2){
        $this->recibir = ((float) $this->cantidad * (float) $this->precio1['price']) / (float) $this->precio2['price'];
        $this->nombre2 = Crypto::select('abr')->where('id','=', $crypto2)->get();
    }

    public function updatedprueba($crypto1){
        $this->nombre1 = Crypto::select('abr')->where('id','=', $crypto1)->get();

    }


}
