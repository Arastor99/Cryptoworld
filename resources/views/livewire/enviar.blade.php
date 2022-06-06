<div>
    <label for="">¿Que crypto quieres recibir?</label>

<select wire:model="prueba">
    <option>Seleccione una cryptomoneda</option>
    @foreach ($cryptos as $crypto)
        <option value="{{$crypto->id}}">{{$crypto->nombre}}</option>
    @endforeach
</select>
@if(!is_null($prueba))
<div> Cantidad disponible: {{$prueba[0]->cantidad}}</div>
<form action="/cartera/enviar" method="POST">
    @csrf
    <label for="direccion"> Direccion </label>
    <input type="text" name="direccion" id="direccion">
    <br>
    <label for="cantidad"> Cantidad </label>
    <input type="text" name="cantidad" id="cantidad">
    <br>
    <input type="hidden" name="cryptoid" id="cryptoid" value={{$prueba[0]->crypto_id}}>
    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Enviar</button>
</form>
@endif
</div>
