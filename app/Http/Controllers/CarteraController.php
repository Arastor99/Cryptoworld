<?php

namespace App\Http\Controllers;

use App\Models\Cartera;
use App\Models\Direccion;
use App\Models\Crypto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\PreciosController;
use App\Models\CarteraFiat;
use App\Models\Fiat;

class CarteraController extends Controller
{


    public function index(){
        $binance = new PreciosController();

        return view('livewire.index',
        [
            'binance' => $binance
        ]);
    }
    public function crear_carteras($usuario){
        //Cambiar hash por un UUID con algoritmo sha256
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
        for ($i=0; $i < DB::table('fiats')->max('id'); $i++) {
            CarteraFiat::create([
                'user_id' => $usuario->id,
                'fiat_id' => Fiat::find($i+1)->id,
            ]);
        }



    }

    public function enviar(Request $request){
        //falta controlar que la cantidad no pueda ser negativa en la base de datos -done-
        //controlar tambien que no puedas enviarte cryptos a ti mismo -done-
        //refactorizar la funcion para poder usarla con todas las cryptos y no tener que hacer una funcion para cada una de ellas. -done-
        //controlar que no se pueda enviar entre distintas monedas por ejemplo enviar 0.5btc a la cartera de ada -done-

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

        $direccion = Direccion::select('direccion')
        ->where('crypto_id', '=', $request->cryptoid)
        ->where('user_id','=', Auth::user()->id)
        ->get();

        //controla que el usuario no pueda enviarse a si mismo.
        if($direccion[0]->direccion == $request->direccion)
        {
            return redirect('/cartera/enviar')->with('error','No puedes enviarte activos a ti mismo');
        }

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

    public function convertir(Request $request){
        //se recuperan los datos de nuevo por si llegan modificados externamente y se realizaran excepciones en caso de discrepancias.
        //falta validaciones
        //cambiar floats por decimal o numeric
        $crypto1 = Crypto::select('abr')->where('id', '=', $request->cryptoid1)->get();
        $crypto2 = Crypto::select('abr')->where('id', '=', $request->cryptoid2)->get();
        $binance = new PreciosController();
        $precio1 = $binance->precio($crypto1[0]->abr . 'EUR');
        $precio2 = $binance->precio($crypto2[0]->abr . 'EUR');


        //$elimina es la cantidad que hay que retirarle al usuario de la crypto1
        //$recibe es la cantidad que hay que añadirle al usuario de la crypto2
        $elimina = $request->cantidad;
        $recibe = ((float) $elimina * (float) $precio1['price']) / (float) $precio2['price'];

        $tiene = Cartera::select('carteras.cantidad')
        ->join('direcciones','carteras.direccion_id','=','direcciones.id')
        ->where('carteras.user_id','=', Auth::user()->id)
        ->where('direcciones.crypto_id', '=', $request->cryptoid1)->get();


        if($tiene < $request->cantidad){
            return redirect('/cartera/convertir')->with('error','No dispones de esa cantidad');
        }
        $total = (float) $tiene[0]->cantidad - (float) $elimina;

        Cartera::select('carteras.cantidad')
        ->join('direcciones','carteras.direccion_id','=','direcciones.id')
        ->where('carteras.user_id','=', Auth::user()->id)
        ->where('direcciones.crypto_id', '=', $request->cryptoid1)
        ->update(['carteras.cantidad' => $total]);



        $tiene2 = Cartera::select('carteras.cantidad')
        ->join('direcciones','carteras.direccion_id','=','direcciones.id')
        ->where('carteras.user_id','=', Auth::user()->id)
        ->where('direcciones.crypto_id', '=', $request->cryptoid2)->get();

        $total2 = (float) $tiene2[0]->cantidad + (float) $recibe;



        Cartera::select('carteras.cantidad')
        ->join('direcciones','carteras.direccion_id','=','direcciones.id')
        ->where('carteras.user_id','=', Auth::user()->id)
        ->where('direcciones.crypto_id', '=', $request->cryptoid2)
        ->update(['carteras.cantidad' => $total2]);
    }

    public function visualizar(){
        $total = 0;
        $total_cryptos = 0;
        $total_fiats = 0;
        $cryptos = DB::table('carteras')
        ->select('cryptos.abr','carteras.cantidad')
        ->join('direcciones','direcciones.id','=','carteras.direccion_id')
        ->join('cryptos','cryptos.id','=','direcciones.crypto_id')
        ->where('carteras.user_id','=',Auth::user()->id)
        ->get();




        $fiat = DB::table('fiats')
        ->select('fiats.divisa','cartera_fiats.cantidad')
        ->join('cartera_fiats','fiats.id','=','cartera_fiats.fiat_id')
        ->where('cartera_fiats.user_id','=', Auth::user()->id)
        ->get();

        $binance = new PreciosController();

        foreach ($cryptos as $crypto){
            $total_cryptos += (round($binance->precio($crypto->abr . 'EUR')['price'],2) * $crypto->cantidad);
        }

        foreach($fiat as $fit){
            $total_fiats += $fit->cantidad;
        }
        $total = $total_cryptos + $total_fiats;
        //eur to btc
        $btc = $total / $binance->precio('BTCEUR')['price'];
        $btc_cryptos = $total_cryptos / $binance->precio('BTCEUR')['price'];
        $btc_fiats = $total_fiats / $binance->precio('BTCEUR')['price'];
        return view('cartera',
        [
            'cryptos' => $cryptos,
            'binance' => $binance,
            'fiats' => $fiat,
            'total' => $total,
            'total_cryptos' => $total_cryptos,
            'total_fiats' => $total_fiats,
            'btc' => $btc,
            'btc_cryptos' => $btc_fiats,
            'btc_fiats' => $btc_fiats,
        ]);
    }

    public function vender(Request $request){
        //falta hacer comprobaciones antes de realizar cualquier operacion.
        $binance = new PreciosController();

        $abr = Crypto::select('abr')
        ->where('id','=', $request->cryptoid)
        ->first();

        $precio = $binance->precio($abr->abr . 'EUR');
        $total = (float) $request->cantidad * (float) $precio['price'];

        $cantidadAntigua = Cartera::select('cantidad')
                        ->join('direcciones','carteras.direccion_id', '=', 'direcciones.id')
                        ->join('cryptos', 'cryptos.id', '=', 'direcciones.crypto_id')
                        ->where('carteras.user_id', '=', Auth::user()->id)
                        ->where('cryptos.abr', '=', $abr->abr)
                        ->first();

        if($cantidadAntigua < $request->cantidad){
            return redirect('/cartera/enviar')->with('error','No dispones de esa cantidad.');
        }

        $cantidadNueva = (float) $cantidadAntigua->cantidad - (float) $request->cantidad;

        Cartera::select('cantidad')
        ->join('direcciones','carteras.direccion_id', '=', 'direcciones.id')
        ->join('cryptos', 'cryptos.id', '=', 'direcciones.crypto_id')
        ->where('carteras.user_id', '=', Auth::user()->id)
        ->where('cryptos.abr', '=', $abr->abr)
        ->update(['carteras.cantidad' => $cantidadNueva]);



        $euros = CarteraFiat::select('cantidad')
                ->join('fiats','cartera_fiats.fiat_id', '=', 'fiats.id')
                ->where('cartera_fiats.user_id', '=', Auth::user()->id)
                ->first();

        $eurosNuevos = (float) $euros->cantidad + (float) $total;

        CarteraFiat::select('cantidad')
                ->join('fiats','cartera_fiats.fiat_id', '=', 'fiats.id')
                ->where('cartera_fiats.user_id', '=', Auth::user()->id)
                ->update(['cartera_fiats.cantidad' => $eurosNuevos]);


    }

    public function mercado(){
        return view('mercado');
    }

    public function comprar(){
        return view ('comprar', [
            'cryptos' => Crypto::all()
        ]);
    }

    public function checkout(Request $request){

        $crypto = Crypto::select('abr')->where('id', '=', $request->crypto)->get();
        $binance = new PreciosController();
        $precio = $binance->precio($crypto[0]->abr . 'EUR');
        $total = $request->cantidad * $precio['price'];

       return view('checkout',[
           'cantidad' => $request->cantidad,
           'precio' => $total,
           'abr' => $crypto[0]->abr,
           'crypto_id' => $request->crypto,
       ]);

    }

    public function retirar(){
        return view('retirar');
    }

    public function retirada(Request $request){
        return view('retirada',[
            'cantidad' => $request->cantidad,
        ]);
    }
}
