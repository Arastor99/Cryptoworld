<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cartera;
use App\Models\CarteraFiat;
use App\Models\Crypto;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{
    public function index(){
        $datos = User::paginate(5);
        return view('usuario.index', [
        'datos' => $datos
        ]);
    }


    public function create(){
        return view('usuario.create');
    }


    public function store(Request $request){
        $datosUsuario = request()->except('_token');
        User::insert($datosUsuario);
        return redirect('usuarios');

    }

    public function destroy($id)
    {
        User::destroy($id);
        return redirect('usuarios');
    }

    public function edit($id){

        $usuario = User::findOrFail($id);

        $informacionUsuario = DB::table('users')
        ->select('users.nombre','users.apellidos','users.nickname', 'users.email','carteras.cantidad','cryptos.abr')
        ->join('carteras','carteras.user_id', '=', 'users.id')
        ->join('direcciones', 'carteras.direccion_id', '=', 'direcciones.id')
        ->join('cryptos','cryptos.id', '=', 'direcciones.crypto_id')
        ->where('users.id', '=', $usuario->id)
        ->get();

        $dineroUsuario = DB::table('cartera_fiats')
        ->select('cantidad')
        ->where('user_id', '=', $usuario->id)
        ->get();
        return view('usuario.edit', [
            'usuario' => $usuario,
            'informacionUsuario' => $informacionUsuario,
            'dineroUsuario' => $dineroUsuario
        ]);
    }

    public function update(Request $request, $id){
        $datosUsuario = request()->except(['_token','_method','BTC','ETH','ADA','BNB','EUR']);

        User::where('id', '=', $id)->update($datosUsuario);

        $cryptosUsuario = request()->except(['_token','_method','nombre','apellidos','email','nickname','EUR']);

        $cantidadCryptos = DB::table('cryptos')->count();;


        for ($i=0; $i <= $cantidadCryptos-1 ; $i++) {
            Cartera::select('carteras.cantidad', 'cryptos.abr')
            ->join('direcciones','direcciones.id', '=','carteras.direccion_id')
            ->join('cryptos','cryptos.id','=', 'direcciones.crypto_id')
            ->where('carteras.user_id','=',$id)
            ->where('cryptos.abr','=', array_keys($cryptosUsuario)[$i])
            ->update(['carteras.cantidad' => $cryptosUsuario[array_keys($cryptosUsuario)[$i]]]);
        }

        $dineroUsuario = request()->except(['_token','_method','BTC','ETH','ADA','BNB','nombre','apellidos','email','nickname']);

        CarteraFiat::where('cartera_fiats.user_id','=', $id)
        ->update(['cantidad' => $dineroUsuario['EUR']]);
        return redirect('/usuarios')
            ->with('success', 'Usuario modificado con éxito.');
    }

}
