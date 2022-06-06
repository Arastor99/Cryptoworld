<div>
    <label for="">¿Que crypto quieres convertir?</label>
    <br>
    <label>De </label>
    <select wire:model="crypto1">
        <option></option>
        @foreach ($cryptos as $crypto)
            <option value="{{$crypto->id}}">{{$crypto->abr}}</option>
        @endforeach
    </select>
        <label>A</label>
    <select wire:model="crypto2">
            <option></option>
            @foreach ($cryptos as $crypto)
                <option value="{{$crypto->id}}">{{$crypto->abr}}</option>
            @endforeach
    </select>
    @if(!is_null ($crypto1) && !is_null ($crypto2))
    <form action="/cartera/convertir" method="POST">
        <div> Cantidad disponible:</div>
        @csrf
        <label for="cantidad"> Cantidad de  que quieres convertir </label>
        <input wire:model="cantidad" type="text" name="cantidad" id="cantidad">
        <br>
        @if(!is_null ($recibir))
        <label  for="recibir"> Recibiras {{$recibir}} de {{$nombre1[0]->abr}}</label>
        <br>
        <input type="hidden" name="cryptoid1" id="cryptoid1" value={{$crypto1}}>
        <input type="hidden" name="cryptoid2" id="cryptoid2" value={{$crypto2}}>
        <input type="hidden" name="precio1" id="precio1" value={{$precio1['price']}}>
        <input type="hidden" name="precio2" id="precio2" value={{$precio2['price']}}>


        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Convertir</button>
    </form>
        @endif
        @endif

</div>
