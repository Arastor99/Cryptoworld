<?php

namespace App\Http\Livewire;

use App\Http\Controllers\PreciosController;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $binance = new PreciosController();
        return view('livewire.index',
        [
            'binance' => $binance
        ]);
    }
}
