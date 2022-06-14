<?php

namespace App\Http\Livewire;

use App\Models\Crypto;
use Livewire\Component;
use App\Http\Controllers\PreciosController;
use App\Models\Cartera;
use Illuminate\Support\Facades\Auth;

class Vender extends Component
{
    public $cripto1;
    public $cantidad;
    public $nombre1;
    public $total;
    public $precio;
    public $disponible;
    public function render()
    {
        return view('livewire.vender', [
            'cryptos' => Crypto::all()
        ]);
    }




    public function updatedcripto1()
    {

        $this->disponible = Cartera::select('cantidad')
            ->join('direcciones', 'carteras.direccion_id', '=', 'direcciones.id')
            ->join('cryptos', 'cryptos.id', '=', 'direcciones.crypto_id')
            ->where('carteras.user_id', '=', Auth::user()->id)
            ->where('cryptos.id', '=', $this->cripto1)
            ->first();
        $this->disponible = $this->disponible->cantidad;


        if (!empty($this->cripto1)) {
            $this->nombre1 = Crypto::select('abr')->where('id', '=', $this->cripto1)->get();
            $this->nombre1 = $this->nombre1[0]->abr;
        }


        if (!empty($this->cripto1) && !empty($this->cantidad)) {
            $binance = new PreciosController();

            $this->precio = $binance->precio($this->nombre1 . 'EUR');
            $this->total = (float) $this->cantidad *  (float) $this->precio['price'];

        } else {
        }
    }


    public function updatedcantidad()
    {

        if (!empty($this->cripto1)) {
            $this->nombre1 = Crypto::select('abr')->where('id', '=', $this->cripto1)->get();
            $this->nombre1 = $this->nombre1[0]->abr;
        }



        if (!empty($this->cripto1) && !empty($this->cantidad)) {
            $binance = new PreciosController();

            $this->precio = $binance->precio($this->nombre1 . 'EUR');
            $this->total = $this->cantidad * $this->precio['price'];
        } else {
        }
    }
}
