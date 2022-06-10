<?php

namespace App\Http\Livewire;

use App\Models\Crypto;
use Livewire\Component;
use App\Http\Controllers\PreciosController;
use App\Models\Cartera;
use Illuminate\Support\Facades\Auth;

class Convertir extends Component
{
    public $cripto;
    public $cripto1;
    public $cripto2;
    public $cantidad;
    public $nombre1;
    public $nombre2;
    public $total;
    public $precio1;
    public $precio2;
    public $disponible;
    public function render()
    {
        return view('livewire.convertir', [
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
        if (!empty($this->cripto2)) {
            $this->nombre2 = Crypto::select('abr')->where('id', '=', $this->cripto2)->get();
            $this->nombre2 = $this->nombre2[0]->abr;
        }


        if (!empty($this->cripto1) && !empty($this->cripto2) && !empty($this->cantidad)) {
            $binance = new PreciosController();

            $this->precio1 = $binance->precio($this->nombre1 . 'EUR');
            $this->precio2 = $binance->precio($this->nombre2 . 'EUR');

            $this->total = (float) $this->cantidad * (float) $this->precio1['price'] / (float) $this->precio2['price'];
        } else {
        }
    }


    public function updatedcripto2()
    {
        if (!empty($this->cripto1)) {
            $this->nombre1 = Crypto::select('abr')->where('id', '=', $this->cripto1)->get();
            $this->nombre1 = $this->nombre1[0]->abr;
        }
        if (!empty($this->cripto2)) {
            $this->nombre2 = Crypto::select('abr')->where('id', '=', $this->cripto2)->get();
            $this->nombre2 = $this->nombre2[0]->abr;
        }


        if (!empty($this->cripto1) && !empty($this->cripto2) && !empty($this->cantidad)) {
            $binance = new PreciosController();

            $this->precio1 = $binance->precio($this->nombre1 . 'EUR');
            $this->precio2 = $binance->precio($this->nombre2 . 'EUR');

            $this->total = (float) $this->cantidad * (float) $this->precio1['price'] / (float) $this->precio2['price'];
        } else {
        }
    }

    public function updatedcantidad()
    {
        if (!empty($this->cripto1)) {
            $this->nombre1 = Crypto::select('abr')->where('id', '=', $this->cripto1)->get();
            $this->nombre1 = $this->nombre1[0]->abr;
        }
        if (!empty($this->cripto2)) {
            $this->nombre2 = Crypto::select('abr')->where('id', '=', $this->cripto2)->get();
            $this->nombre2 = $this->nombre2[0]->abr;
        }


        if (!empty($this->cripto1) && !empty($this->cripto2) && !empty($this->cantidad)) {
            $binance = new PreciosController();

            $this->precio1 = $binance->precio($this->nombre1 . 'EUR');
            $this->precio2 = $binance->precio($this->nombre2 . 'EUR');

            $this->total = (float) $this->cantidad * (float) $this->precio1['price'] / (float) $this->precio2['price'];
        } else {
        }
    }
}
