<x-app-layout>
<form action="{{url('/usuarios/'.$usuario->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
<label for="nombre"> Nombre </label>
<input type="text" name="nombre" id="nombre" value={{$informacionUsuario[0]->nombre}}>
<br>
<label for="apellidos"> Apellidos </label>
<input type="text" name="apellidos" id="apellidos" value={{$informacionUsuario[0]->apellidos}}>
<br>
<label for="email"> Email </label>
<input type="text" name="email" id="email" value={{$informacionUsuario[0]->email}}>
<br>
<label for="nickname"> Nombre de usuario </label>
<input type="text" name="nickname" id="nickname" value={{$informacionUsuario[0]->nickname}}>
<br>
<label for="BTC"> BTC </label>
<input type="text" name="BTC" id="BTC" value={{$informacionUsuario[0]->cantidad}} >
<br>
<label for="ETH"> ETH </label>
<input type="text" name="ETH" id="ETH" value={{$informacionUsuario[1]->cantidad}}>
<br>
<label for="ADA"> ADA </label>
<input type="text" name="ADA" id="ADA" value={{$informacionUsuario[2]->cantidad}}>
<br>
<label for="BNB"> BNB </label>
<input type="text" name="BNB" id="BNB" value={{$informacionUsuario[3]->cantidad}}>
<br>
<label for="EUR"> EUR </label>
<input type="text" name="EUR" id="EUR" value={{$dineroUsuario[0]->cantidad}}>
<br>
<button type="submit"
    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Enviar</button>

    </form>
</x-app-layout>
