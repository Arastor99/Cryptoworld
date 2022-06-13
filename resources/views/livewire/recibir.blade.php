<div class="bg-oscurito ">

    <div class="min-h-screen container mx-auto  text-white " style="background-color: #181A20">

        <div class="h-48 bg-repeat-x object-scale-down flex items-center justify-center " style="background-image: url('/img/bg.png'); background-size: contain; background-size: 100%;">
            <h1 class="text-3xl"><b>Cryptoworld Recieve</b></h1>
        </div>


        <div class="bg-oscurito flex place-content-center  h-screen rounded-t-[3rem] -pt-16 ">
            <div class=" h-96 mt-20 place-content-center  grid grid-cols-4 grow mx-12 p-20">

                    <h1 class="h-auto w-auto  col-span-3 ">Dirección</h1>
                    <h1 class="h-auto w-auto  col-span-1">Disponible: {{ $disponible }} {{ $nombre1 }}</h1>
                    <input wire:model="direccion" type="text" name="direccion" id="direccion"
                        class="flex h-14 w-auto  rounded-l-lg text-black col-span-3 bg-gray-200 px-5 text-xl border-r-1" readonly>
                    <select wire:model="cripto1"
                        class=" border-t-2 rounded-r-lg col-span-1 bg-gray-200 text-black ">
                        <option></option>
                        @foreach ($cryptos as $crypto)
                            <option class="text-black text-xl text-center" value="{{ $crypto->id }}"
                                style="background-image:url('/img/btc.png');">{{ $crypto->abr }}</option>
                        @endforeach
                    </select>

                    @if ($errors->any())
                        <h2 class="text-red-400 col-start-4">{{ $errors->first() }}</h2>
                    @endif
                </div>
                <div>
        </div>
    </div>
</div>

</div>
