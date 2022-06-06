<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cartera;
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
        return view('usuario.edit', compact('usuario'));
    }

    public function update(Request $request, $id){
        $datosUsuario = request()->except(['_token','_method']);
        User::where('id', '=', $id)->update($datosUsuario);
        return redirect('/usuarios')
            ->with('success', 'Usuario modificado con éxito.');
    }

}
