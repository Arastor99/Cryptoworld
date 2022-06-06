<x-app-layout>
<form action="/checkout" method="post">
    @csrf
<label>¿Que moneda quieres comprar?</label>
<select name='crypto' id='crypto'>
    <option></option>
    @foreach ($cryptos as $crypto)
        <option value="{{$crypto->id}}">{{$crypto->abr}}</option>
    @endforeach
</select>
<label>Cantidad</label>
<input wire:model="cantidad" type="text" name="cantidad" id="cantidad">
<button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Vender</button>
</form>
</x-app-layout>
