<?php

namespace App\Http\Controllers;

use App\Models\Cartera;
use App\Models\Direccion;
use App\Models\Crypto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\PreciosController;
use Ramsey\Uuid\Uuid;

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

    public function enviar(Request $request){
        //falta controlar que la cantidad no pueda ser negativa en la base de datos
        //controlar tambien que no puedas enviarte cryptos a ti mismo
        //si se envia a una cartera que no existe o pertenece a otro tipo de cryptomoneda, el usuario perdera el activo puesto que simulando la blockchain depende del usuario hacerlo bien
        //refactorizar la funcion para poder usarla con todas las cryptos y no tener que hacer una funcion para cada una de ellas.
        //controlar que no se pueda enviar entre distintas monedas por ejemplo enviar 0.5btc a la cartera de ada
        $disponible_emisor = Cartera::select('carteras.cantidad')
        ->join('direcciones','carteras.direccion_id', '=','direcciones.id')
        ->where('direcciones.crypto_id', '=', '1')
        ->where('carteras.user_id', '=', Auth::user()->id)
        ->get();

        $disponible_receptor = Cartera::select('carteras.cantidad')
        ->join('direcciones','carteras.direccion_id', '=','direcciones.id')
        ->where('direcciones.crypto_id', '=', $request->cryptoid)
        ->where('direcciones.direccion', '=', $request->direccion)
        ->get();
        //si el usuario dispone de menos dinero del que quiere enviar se le redirigira de nuevo a la vista enviar
        if ($disponible_emisor[0]->cantidad < $request->cantidad)
        {
            return redirect('/cartera/enviar')->with('error', 'No dispones de esa cantidad');
        }

        $cryptoid = Direccion::select('crypto_id')->where('direccion', '=', $request->direccion)->get();

        if($cryptoid[0]->crypto_id != $request->cryptoid){
            return redirect('/cartera/enviar')->with('error', 'La cartera a la que estar enviando no pertenece a la misma moneda');
        }

        $restante = (float) $disponible_emisor[0]->cantidad - (float) $request->cantidad;
        $balancenuevo =  (float) $disponible_receptor[0]->cantidad + (float) $request->cantidad;

        Cartera::select('carteras.cantidad')
        ->join('direcciones','carteras.direccion_id', '=','direcciones.id')
        ->where('direcciones.crypto_id', '=', $request->cryptoid)
        ->where('carteras.user_id', '=', Auth::user()->id)
        ->update( ['carteras.cantidad' => $restante]);

        Cartera::select('carteras.cantidad')
        ->join('direcciones','carteras.direccion_id', '=','direcciones.id')
        ->where('direcciones.crypto_id', '=', $request->cryptoid)
        ->where('direcciones.direccion', '=', $request->direccion)
        ->update(['carteras.cantidad' => $balancenuevo]);

        return redirect('cartera/enviar');

    }
/*
    public function convertir(Request $request){

        dd($request);
        $cantidad = $request->cantidad;

        $cantidad_recibir = ($cantidad * $precio1) / $precio2;


    }
*/
}
