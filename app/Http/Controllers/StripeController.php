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
        $binance = new PreciosController();
        dd($request);
        $precio = $binance->precio($request->abr . 'EUR');
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([

                "amount" => (float) $precio['price'] * 100,
                "currency" => "eur",
                "source" => $request->stripeToken,
                "description" => "Esta pago es prueba"
        ]);

        Session::flash('success', 'Pago realizado con éxito');


        $cantidadActual = Cartera::select('carteras.cantidad')
        ->join('direcciones','carteras.direccion_id','=','direcciones.id')
        ->where('carteras.user_id','=', Auth::user()->id)
        ->where('direcciones.crypto_id', '=', $request->crypto_id)->get();


        Cartera::select('carteras.cantidad')
        ->join('direcciones','carteras.direccion_id','=','direcciones.id')
        ->where('carteras.user_id','=', Auth::user()->id)
        ->where('direcciones.crypto_id', '=', $request->crypto_id)
        ->update(['carteras.cantidad' => $cantidadActual[0]->cantidad + $request->cantidad]);
        return app('App\Http\Controllers\CarteraController')->visualizar();
    }

    public function stripePost1(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([

                "amount" => $request->cantidad * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Retirada de dinero"
        ]);

        Session::flash('success', 'Payment successful!');


        $efectivo = CarteraFiat::select('cantidad')
                    ->where('user_id', '=', Auth::user()->id)
                    ->get();



        CarteraFiat::select('cantidad')
        ->where('user_id', '=', Auth::user()->id)
        ->update(['cantidad','=', ($efectivo[0]->cantidad - $request->cantidad)]);
        return back();
    }
}
