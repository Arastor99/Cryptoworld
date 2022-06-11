<?php

namespace App\Http\Livewire;

use App\Models\Crypto;
use Livewire\Component;
use App\Http\Controllers\PreciosController;
use App\Models\Cartera;
use Illuminate\Support\Facades\Auth;

class Comprar extends Component
{
    public $cripto1;
    public $cantidad;
    public $nombre1;
    public $total;
    public $precio;
    public $recibir;

    public function render()
    {
        return view('livewire.comprar', [
            'cryptos' => Crypto::all()
        ]);
    }




    public function updatedcripto1()
    {

        if (!empty($this->cripto1)) {
            $this->nombre1 = Crypto::select('abr')->where('id', '=', $this->cripto1)->get();
            $this->nombre1 = $this->nombre1[0]->abr;
        }


        if (!empty($this->cripto1) && !empty($this->cantidad)) {
            $binance = new PreciosController();

            $this->precio = $binance->precio($this->nombre1 . 'EUR');
            $this->total = (float) $this->cantidad / (float) $this->precio['price'];

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
            $this->total = (float) $this->cantidad / (float) $this->precio['price'];
        } else {
        }
    }
}
