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


    public function index()
    {
        $binance = new PreciosController();

        return view(
            'livewire.index',
            [
                'binance' => $binance
            ]
        );
    }
    public function crear_carteras($usuario)
    {
        //Cambiar hash por un UUID con algoritmo sha256
        $hash = array();

        for ($i = 1; $i <= DB::table('cryptos')->max('id'); $i++) {
            array_push($hash, (hash('sha256', (time() + rand(1, 10000)))));
        }

        $indice_mayor_hash = array_key_last($hash);

        for ($i = 0; $i <= $indice_mayor_hash; $i++) {
            $direccion = Direccion::create([
                'direccion' => $hash[$i],
                'crypto_id' => Crypto::find($i + 1)->id,
                'user_id' => $usuario->id,
            ]);

            Cartera::create([
                'nombre'  => $usuario->nickname,
                'user_id' => $usuario->id,
                'direccion_id' => $direccion->id,
            ]);
        }
        for ($i = 0; $i < DB::table('fiats')->max('id'); $i++) {
            CarteraFiat::create([
                'user_id' => $usuario->id,
                'fiat_id' => Fiat::find($i + 1)->id,
            ]);
        }
    }

    public function enviar(Request $request)
    {
        //terminado
        //falta controlar que la cantidad no pueda ser negativa en la base de datos -done-
        //controlar tambien que no puedas enviarte cryptos a ti mismo -done-
        //refactorizar la funcion para poder usarla con todas las cryptos y no tener que hacer una funcion para cada una de ellas. -done-
        //controlar que no se pueda enviar entre distintas monedas por ejemplo enviar 0.5btc a la cartera de ada -done-
        $validated = $request->validate([
            'direccion' => 'required|max:255',
            'cantidad' => 'required',
            'cryptoid' => 'required',
        ]);

        $direccion = $validated['direccion'];
        $cantidad = $validated['cantidad'];
        $cryptoid = $validated['cryptoid'];

        $disponible_emisor = Cartera::select('carteras.cantidad')
            ->join('direcciones', 'carteras.direccion_id', '=', 'direcciones.id')
            ->where('direcciones.crypto_id', '=', $cryptoid)
            ->where('carteras.user_id', '=', Auth::user()->id)
            ->get();

        $disponible_receptor = Cartera::select('carteras.cantidad')
            ->join('direcciones', 'carteras.direccion_id', '=', 'direcciones.id')
            ->where('direcciones.crypto_id', '=', $cryptoid)
            ->where('direcciones.direccion', '=', $direccion)
            ->get();

        $direccion_propia = Direccion::select('direccion')
            ->where('crypto_id', '=', $cryptoid)
            ->where('user_id', '=', Auth::user()->id)
            ->get();

        //controla que el usuario no pueda enviarse a si mismo.
        if ($direccion_propia[0]->direccion == $direccion) {

            return redirect('/cartera/enviar')->withErrors('error', 'No puedes enviarte activos a ti mismo');
        }
        //si el usuario dispone de menos dinero del que quiere enviar se le redirigira de nuevo a la vista enviar
        if ($disponible_emisor[0]->cantidad < $cantidad) {

            return redirect('/cartera/enviar')->withErrors('No dispones de esa cantidad');
        }
        $cryptoid1 = Direccion::select('crypto_id')->where('direccion', '=', $direccion)->get();
        if ($cryptoid1->isEmpty()) {

            return redirect('/cartera/enviar')->withErrors('La direccion introducida no pertenece a nadie');

        } else if ($cryptoid1[0]->crypto_id != $cryptoid) {
            return redirect('/cartera/enviar')->withErrors('La direccion introducida no pertenece a la moneda que esta intentando enviar');
        }
        $restante = (float) $disponible_emisor[0]->cantidad - (float) $cantidad;
        $balancenuevo =  (float) $disponible_receptor[0]->cantidad + (float) $cantidad;

        Cartera::select('carteras.cantidad')
            ->join('direcciones', 'carteras.direccion_id', '=', 'direcciones.id')
            ->where('direcciones.crypto_id', '=', $cryptoid)
            ->where('carteras.user_id', '=', Auth::user()->id)
            ->update(['carteras.cantidad' => $restante]);

        Cartera::select('carteras.cantidad')
            ->join('direcciones', 'carteras.direccion_id', '=', 'direcciones.id')
            ->where('direcciones.crypto_id', '=', $cryptoid)
            ->where('direcciones.direccion', '=', $direccion)
            ->update(['carteras.cantidad' => $balancenuevo]);

        return redirect('cartera/enviar')->with('success', 'Envio realizado correctamente');
    }

    public function convertir(Request $request)
    {
        //se recuperan los datos de nuevo por si llegan modificados externamente y se realizaran excepciones en caso de discrepancias.
        //falta validaciones
        //cambiar floats por decimal o numeric

        $validated = $request->validate([
            'cantidad' => 'required|max:255',
            'cryptoid1' => 'required',
            'cryptoid2' => 'required',
        ]);

        $cantidad = $validated['cantidad'];
        $cryptoid1 = $validated['cryptoid1'];
        $cryptoid2 = $validated['cryptoid2'];



        $crypto1 = Crypto::select('abr')->where('id', '=', $cryptoid1)->get();
        $crypto2 = Crypto::select('abr')->where('id', '=', $cryptoid2)->get();
        $binance = new PreciosController();
        $precio1 = $binance->precio($crypto1[0]->abr . 'EUR');
        $precio2 = $binance->precio($crypto2[0]->abr . 'EUR');

        if ($cantidad <= 0) {
            return redirect('/cartera/convertir')->withErrors('No puedes convertir 0 o menor que 0');
        }
        $direccion = Direccion::select('direccion')->where('crypto_id', '=', $cryptoid1)->get();

        $disponible = Cartera::select('carteras.cantidad')
            ->join('direcciones', 'carteras.direccion_id', '=', 'direcciones.id')
            ->where('direcciones.crypto_id', '=', $cryptoid1)
            ->where('direcciones.direccion', '=', $direccion[0]->direccion)
            ->get();
        if ($disponible[0]->cantidad < $cantidad) {
            return redirect('/cartera/convertir')->withErrors('No dispones de esa cantidad');
        }

        //$elimina es la cantidad que hay que retirarle al usuario de la crypto1
        //$recibe es la cantidad que hay que añadirle al usuario de la crypto2
        $elimina = $cantidad;
        $recibe = ((float) $elimina * (float) $precio1['price']) / (float) $precio2['price'];

        $tiene = Cartera::select('carteras.cantidad')
            ->join('direcciones', 'carteras.direccion_id', '=', 'direcciones.id')
            ->where('carteras.user_id', '=', Auth::user()->id)
            ->where('direcciones.crypto_id', '=', $cryptoid1)->get();


        if ($tiene < $cantidad) {
            return redirect('/cartera/convertir')->withErrors('No dispones de esa cantidad');
        }
        $total = (float) $tiene[0]->cantidad - (float) $elimina;

        Cartera::select('carteras.cantidad')
            ->join('direcciones', 'carteras.direccion_id', '=', 'direcciones.id')
            ->where('carteras.user_id', '=', Auth::user()->id)
            ->where('direcciones.crypto_id', '=', $cryptoid1)
            ->update(['carteras.cantidad' => $total]);



        $tiene2 = Cartera::select('carteras.cantidad')
            ->join('direcciones', 'carteras.direccion_id', '=', 'direcciones.id')
            ->where('carteras.user_id', '=', Auth::user()->id)
            ->where('direcciones.crypto_id', '=', $cryptoid2)->get();

        $total2 = (float) $tiene2[0]->cantidad + (float) $recibe;



        Cartera::select('carteras.cantidad')
            ->join('direcciones', 'carteras.direccion_id', '=', 'direcciones.id')
            ->where('carteras.user_id', '=', Auth::user()->id)
            ->where('direcciones.crypto_id', '=', $request->cryptoid2)
            ->update(['carteras.cantidad' => $total2]);

        return redirect()->back()->with('success', 'Conversión realizada con exito');
    }

    public function visualizar()
    {
        $total = 0;
        $total_cryptos = 0;
        $total_fiats = 0;
        $cryptos = DB::table('carteras')
            ->select('cryptos.abr', 'carteras.cantidad')
            ->join('direcciones', 'direcciones.id', '=', 'carteras.direccion_id')
            ->join('cryptos', 'cryptos.id', '=', 'direcciones.crypto_id')
            ->where('carteras.user_id', '=', Auth::user()->id)
            ->get();




        $fiat = DB::table('fiats')
            ->select('fiats.divisa', 'cartera_fiats.cantidad')
            ->join('cartera_fiats', 'fiats.id', '=', 'cartera_fiats.fiat_id')
            ->where('cartera_fiats.user_id', '=', Auth::user()->id)
            ->get();

        $binance = new PreciosController();

        foreach ($cryptos as $crypto) {
            $total_cryptos += (round($binance->precio($crypto->abr . 'EUR')['price'], 2) * $crypto->cantidad);
        }

        foreach ($fiat as $fit) {
            $total_fiats += $fit->cantidad;
        }
        $total = $total_cryptos + $total_fiats;
        //eur to btc
        $btc = $total / $binance->precio('BTCEUR')['price'];
        $btc_cryptos = $total_cryptos / $binance->precio('BTCEUR')['price'];
        $btc_fiats = $total_fiats / $binance->precio('BTCEUR')['price'];
        return view(
            'cartera',
            [
                'cryptos' => $cryptos,
                'binance' => $binance,
                'fiats' => $fiat,
                'total' => $total,
                'total_cryptos' => $total_cryptos,
                'total_fiats' => $total_fiats,
                'btc' => $btc,
                'btc_cryptos' => $btc_cryptos,
                'btc_fiats' => $btc_fiats,
            ]
        );
    }

    public function vender(Request $request)
    {
        //falta hacer comprobaciones antes de realizar cualquier operacion.

        $validated = $request->validate([
            'cantidad' => 'required|max:255',
            'cryptoid' => 'required',
        ]);

        $cantidad = $validated['cantidad'];
        $cryptoid = $validated['cryptoid'];
        $binance = new PreciosController();

        $abr = Crypto::select('abr')
            ->where('id', '=', $cryptoid)
            ->first();

        $precio = $binance->precio($abr->abr . 'EUR');
        $total = (float) $cantidad * (float) $precio['price'];

        $cantidadAntigua = Cartera::select('cantidad')
            ->join('direcciones', 'carteras.direccion_id', '=', 'direcciones.id')
            ->join('cryptos', 'cryptos.id', '=', 'direcciones.crypto_id')
            ->where('carteras.user_id', '=', Auth::user()->id)
            ->where('cryptos.abr', '=', $abr->abr)
            ->first();

        if ($cantidadAntigua->cantidad < $cantidad) {
            return redirect('/cartera/vender')->withErrors('No dispones de esa cantidad.');
        }

        $cantidadNueva = (float) $cantidadAntigua->cantidad - (float) $cantidad;

        Cartera::select('cantidad')
            ->join('direcciones', 'carteras.direccion_id', '=', 'direcciones.id')
            ->join('cryptos', 'cryptos.id', '=', 'direcciones.crypto_id')
            ->where('carteras.user_id', '=', Auth::user()->id)
            ->where('cryptos.abr', '=', $abr->abr)
            ->update(['carteras.cantidad' => $cantidadNueva]);



        $euros = CarteraFiat::select('cantidad')
            ->join('fiats', 'cartera_fiats.fiat_id', '=', 'fiats.id')
            ->where('cartera_fiats.user_id', '=', Auth::user()->id)
            ->first();

        $eurosNuevos = (float) $euros->cantidad + (float) $total;

        CarteraFiat::select('cantidad')
            ->join('fiats', 'cartera_fiats.fiat_id', '=', 'fiats.id')
            ->where('cartera_fiats.user_id', '=', Auth::user()->id)
            ->update(['cartera_fiats.cantidad' => $eurosNuevos]);

        return redirect()->back()->with('success', 'Venta realizada con exito');
    }

    public function mercado()
    {
        return view('mercado');
    }

    public function comprar()
    {
        return view('comprar', [
            'cryptos' => Crypto::all()
        ]);
    }

    public function checkout(Request $request)
    {
        $crypto = Crypto::select('abr')->where('id', '=', $request->cryptoid1)->get();
        $binance = new PreciosController();
        $total = $request->cantidad;
        return view('checkout', [
            'cantidad' => $request->cantidad,
            'precio' => $total,
            'abr' => $crypto[0]->abr,
            'crypto_id' => $request->cryptoid1,
            'recibir' => $request->recibir,
        ]);
    }

    public function retirar()
    {
        return view('retirar');
    }

    public function retirada(Request $request)
    {
        $efectivo = CarteraFiat::select('cantidad')
                    ->where('user_id', '=', Auth::user()->id)
                    ->get();
        if ($efectivo[0]->cantidad < $request->cantidad){
            return redirect('/retirar')->withErrors('No tienes dinero para retirar');

        }
        return view('retirada', [
            'cantidad' => $request->cantidad,
        ]);
    }
}
