<?php

namespace App\Http\Controllers;

use App\Models\Cartera;
use App\Models\CarteraFiat;
use App\Models\Crypto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Stripe;

class StripeController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        $validated = $request->validate([
            'abr' => 'required|max:255',
            'cantidad' => 'required',
            'stripeToken' => 'required',
            'crypto_id' => 'required',
        ]);

        $cantidad = $validated['cantidad'];
        $abr = $validated['abr'];
        $stripeToken = $validated['stripeToken'];
        $crypto_id = $validated['crypto_id'];

        $binance = new PreciosController();
        $precio = $binance->precio($abr . 'EUR');
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([

                "amount" => (float) $cantidad * 100,
                "currency" => "eur",
                "source" => $stripeToken,
                "description" => "Esta pago es prueba"
        ]);

        Session::flash('success', 'Pago realizado con éxito');


        $cantidadActual = Cartera::select('carteras.cantidad')
        ->join('direcciones','carteras.direccion_id','=','direcciones.id')
        ->where('carteras.user_id','=', Auth::user()->id)
        ->where('direcciones.crypto_id', '=', $crypto_id)->get();

        $cantidad_cripto = (float) $cantidad / (float) $precio['price'];
        $total = (float) $cantidadActual[0]->cantidad + $cantidad_cripto;
        Cartera::select('carteras.cantidad')
        ->join('direcciones','carteras.direccion_id','=','direcciones.id')
        ->where('carteras.user_id','=', Auth::user()->id)
        ->where('direcciones.crypto_id', '=', $crypto_id)
        ->update(['carteras.cantidad' => $total]);
        return app('App\Http\Controllers\CarteraController')->visualizar();
    }

    public function stripePost1(Request $request)
    {
        $validated = $request->validate([
            'cantidad' => 'required',
            'stripeToken' => 'required',

        ]);

        $cantidad = $validated['cantidad'];
        $stripeToken = $validated['stripeToken'];

        $efectivo = CarteraFiat::select('cantidad')
                    ->where('user_id', '=', Auth::user()->id)
                    ->get();

        if ($efectivo[0]->cantidad < $cantidad){
            return redirect('/retirar')->withErrors('No tienes dinero para retirar');

        }
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([

                "amount" => $cantidad * 100,
                "currency" => "usd",
                "source" => $stripeToken,
                "description" => "Retirada de dinero"
        ]);

        Session::flash('success', 'Retirada con exito');


        CarteraFiat::select('cantidad')
        ->where('user_id', '=', Auth::user()->id)
        ->update(['cantidad' => ($efectivo[0]->cantidad - $cantidad)]);
        return app('App\Http\Controllers\CarteraController')->visualizar();
    }
}
