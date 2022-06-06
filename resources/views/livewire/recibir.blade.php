<div>
    <label for="">¿Que crypto quieres recibir?</label>

<select wire:model="prueba">
    <option>Seleccione una cryptomoneda</option>
    @foreach ($cryptos as $crypto)
        <option value="{{$crypto->id}}">{{$crypto->nombre}}</option>
    @endforeach
</select>
@if(!is_null($prueba))
<div> Direccion: {{$prueba[0]->direccion}}</div>
@endif
</div>
