<div class="bg-oscurito ">

    <div class="min-h-screen container mx-auto  text-white " style="background-color: #181A20">

        <div class="h-48 bg-repeat-x object-scale-down flex items-center justify-center " style="background-image: url('/img/bg.png'); background-size: contain; background-size: 100%;">
            <h1 class="text-3xl"><b>Cryptoworld Convert</b></h1>
        </div>


        <div class="bg-oscurito flex place-content-center  h-screen rounded-t-[3rem] -pt-16 ">
            <form action="/cartera/convertir" method="post" class=" h-96 mt-20 place-content-center  grid grid-cols-4 grow mx-12 p-20">
                @csrf
                    <h1 class="h-auto w-auto  col-span-3 ">De</h1>
                    <h1 class="h-auto w-auto  col-span-1">Disponible: {{ $disponible }} {{ $nombre1 }}</h1>
                    <input wire:model="cantidad" type="text" name="cantidad" id="cantidad"
                        class="flex h-14 w-auto  rounded-l-lg text-black col-span-3 bg-gray-200 px-5 text-xl border-r-1">
                    <select wire:model="cripto1"
                        class=" border-t-2 rounded-r-lg col-span-1 bg-gray-200 text-black ">
                        <option></option>
                        @foreach ($cryptos as $crypto)
                            <option class="text-black text-xl text-center" value="{{ $crypto->id }}"
                                style="background-image:url('/img/btc.png');">{{ $crypto->abr }}</option>
                        @endforeach
                    </select>
                    <h1 class="h-auto w-auto col-span-4 mt-8">A</h1>
                    <label type="text" name="cantidad" id="cantidad"
                        class="h-14 w-auto border-r-1 rounded-l-lg col-span-3 bg-gray-200 text-black text-xl font-bold flex items-center ">{{ $total }}</label>
                    <select wire:model="cripto2" class=" rounded-r-lg col-span-1 bg-gray-200 text-black text-center">
                        <option></option>
                        @foreach ($cryptos as $crypto)
                            <option class="text-black text-xl" value="{{ $crypto->id }}"><img
                                    class="w-full h-full rounded-full" src="{{ asset('img/' . $crypto->abr . '.png') }}"
                                    alt="" />{{ $crypto->abr }}</option>
                        @endforeach
                    </select>
                    @if (session()->has('success'))
                        <h2 class="text-green-400 col-start-4">
                            {{ session()->get('success') }}
                        </h2>
                    @endif
                    @if ($errors->any())
                        <h2 class="text-red-400 col-start-4">{{ $errors->first() }}</h2>
                    @endif

                    <button type="submit"
                        class="text-white bg-blue-800 hover:bg-blue-900 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-2xl px-5 py-2.5 text-center col-span-2 mt-12 h-20 grow-0 col-start-2">Convertir</button>
                    <input type="hidden" name="cryptoid1" id="cryptoid1" value={{ $cripto1 }}>
                    <input type="hidden" name="cryptoid2" id="cryptoid2" value={{ $cripto2 }}>
                    <input type="hidden" name="cantidad" id="cantidad" value={{ $cantidad }}>
                </form>
                <div>
        </div>
    </div>
</div>

</div>
