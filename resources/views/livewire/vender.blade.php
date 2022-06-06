<div>
    <label for="">¿Que crypto quieres vender?</label>
    <br>
    <label>Vendes </label>
    <select wire:model="crypto1">
        <option></option>
        @foreach ($cryptos as $crypto)
            <option value="{{$crypto->id}}">{{$crypto->abr}}</option>
        @endforeach
    </select>
        <label>Recibes</label>
    <select wire:model="fiat1">
            <option></option>
            @foreach ($fiats as $fiat)
                <option value="{{$fiat->id}}">{{$fiat->divisa}}</option>
            @endforeach
    </select>
    @if(!is_null ($crypto) && !is_null ($fiat))
    <form action="/cartera/vender" method="POST">
        <div> Cantidad disponible:</div>
        @csrf
        <label  for="cantidad"> Cantidad de  que quieres vender </label>
        <input wire:model="cantidad" type="text" name="cantidad" id="cantidad">
        <br>
        @if(!is_null ($recibir))
        <label  for="recibir"> Recibiras {{$recibir}} de </label>
        <br>
        <input type="hidden" name="cryptoid" id="cryptoid" value={{$crypto1}}>
        <input type="hidden" name="precio" id="precio" value={{$precio['price']}}>



        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Vender</button>
    </form>
        @endif
        @endif
</div>
