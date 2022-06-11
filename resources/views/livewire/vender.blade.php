<div class="bg-oscurito ">
    @if($errors->any())
    {{ implode('', $errors->all('<div>:message</div>')) }}
@endif
    <div class="min-h-screen container mx-auto  text-white " style="background-color: #181A20">

        <div class="h-48 bg-repeat-x object-scale-down md:h-96  " style="background-image: url('/img/bg.png') "></div>


        <div class="bg-oscurito  flex place-content-center  h-screen rounded-t-[5rem] -mt-20  ">
            <form action="/cartera/vender" method="post">
                @csrf
            <div class=" h-96 mt-20 place-content-center  grid grid-cols-4 grow mx-12">

                    <h1 class="h-auto w-auto  col-span-2 ">De</h1>
                    <h1 class="h-auto w-auto  col-span-2">Disponible: {{$disponible}} {{$nombre1}}</h1>
                    <input wire:model="cantidad" type="text" name="cantidad" id="cantidad" class="flex h-14 w-auto border-none rounded-l-xl text-black col-span-3 bg-gray-200">
                    <select wire:model="cripto1" class="border-none border-t-2 rounded-r-xl col-span-1 bg-gray-200 text-black">
                        <option></option>
                        @foreach ($cryptos as $crypto)
                            <option class="text-black" value="{{ $crypto->id }}" style="background-image:url('/img/btc.png');">{{ $crypto->abr }}</option>
                        @endforeach
                    </select>
                    <h1 class="h-auto w-auto col-span-4 mt-8">A</h1>
                    <label  type="text" name="cantidad" id="cantidad" class="h-14 w-auto border-none rounded-l-xl col-span-3 bg-gray-200 text-black ">@if(!empty($total)) {{round($total,2)}}@endif</label>
                    <label  type="text" name="cantidad" id="cantidad" class="h-14 w-auto border-none rounded-r-xl col-span-1 bg-gray-200 text-black ">Euros</label>
                    @if (session()->has('success'))
                    <h2 class="text-green-400 col-start-3">
                        {{ session()->get('success') }}
                    </h2>
                    @endif
                    @if ($errors->any())
                        <h2 class="text-red-400 col-start-3">{{ $errors->first() }}</h2>
                    @endif
                    <button type="submit"
                class="text-white bg-blue-800 hover:bg-blue-900 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center col-span-2 mt-12 h-20 grow-0 col-start-2">Convertir</button>
                <input type="hidden" name="cryptoid" id="cryptoid" value={{$cripto1}}>
                <input type="hidden" name="cantidad" id="cantidad" value={{$cantidad}}>

            </div>
        </form>


        </div>
    </div>
</div>

</div>
