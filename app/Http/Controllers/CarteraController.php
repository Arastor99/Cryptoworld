<?php

namespace App\Http\Controllers;

use App\Models\Cartera;
use App\Models\Direccion;
use App\Models\Crypto;
use Illuminate\Support\Facades\DB;

class CarteraController extends Controller
{
    public function crear_carteras($usuario){

        $hash = array();

        for ($i=1; $i <= DB::table('cryptos')->max('id') ; $i++) {
           array_push($hash, (hash('sha256',(time() + rand(1,10000)))));

        }

        $indice_mayor_hash = array_key_last($hash);

        for ($i=0; $i <= $indice_mayor_hash; $i++) {
            $direccion = Direccion::create([
                'direccion' => $hash[$i],
                'crypto_id' => Crypto::find($i+1)->id,
                'user_id' => $usuario->id,
            ]);

            Cartera::create([
                'nombre'  => $usuario->nickname,
                'user_id' => $usuario->id,
                'direccion_id' => $direccion->id,
            ]);
        }
    }

}
