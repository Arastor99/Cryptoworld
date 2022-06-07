<x-app-layout>
    <div>
        <div style="background-color: #181A20">

            <div class="min-h-screen container mx-auto  text-white" style="background-color: #181A20">

                <div class="font-bold flex flex-col md:flex-row  justify-between p-2 text-white">
                    <h1 class="text-lg md:text-4xl">Cuenta spot</h1>
                    <div class="text-base md:text-xl">
                        <button class="p-3 bg-blue-500 rounded-md">Depositar</button>
                        <button class="p-3">Retirar</button>
                        <button class="p-3">Enviar</button>
                        <button class="p-3">Convertir</button>
                    </div>
                </div>
                <div class="flex flex-col md:flex-row py-10 border-b-2 border-gray-600 space-y-10 md:space-y-0 px-2  md:items-center md:justify-between">
                    <div class="space-y-5">
                        <h4 class="font-medium">Balance estimado</h4>
                        <h3 class="text-2xl font-bold">{{$total}}€ BTC {{round($btc,9)}}<h3>
                    </div>
                    <div class="flex items-center justify-between md:space-x-20 lg:space-x-60">
                        <div class="space-y-5">
                            <h4 class="font-medium">Balance spot</h4>
                            <h3 class="text-xl font-bold">{{$total_cryptos}}€ BTC {{round($btc_cryptos,9)}}</h3>
                        </div>
                        <div class="space-y-5">
                            <h4 class="font-medium">Balance fiat</h4>
                            <h3 class="text-xl font-bold">{{$total_fiats}}€ BTC {{round($btc_fiats,9)}}</h3>
                        </div>
                    </div>
                </div>
                <!-- </div> -->

                <div class="rounded-md w-full" style="background-color: #181A20">

                    <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                        <div class="text-sm text-gray-400 align-bottom py-2">
                            Cartera de efectivo
                        </div>
                        <div class="inline-block min-w-full shadow rounded-lg overflow-hidden ">
                            <table class="min-w-full leading-normal">
                                <thead>
                                    <tr>
                                        <th class="px-5 py-3  text-left text-xs font-semibold text-gray-400 uppercase tracking-wider" style="background-color: #2B3139">
                                            Moneda
                                        </th>
                                        <th class="px-5 py-3  text-left text-xs font-semibold text-gray-400 uppercase tracking-wider" style="background-color: #2B3139">
                                            Cantidad
                                        </th>
                                        <th class="px-5 py-3  text-left text-xs font-semibold text-gray-400 uppercase tracking-wider" style="background-color: #2B3139">
                                            Equivalente (€)
                                        </th>
                                        <th class="px-5 py-3  text-left text-xs font-semibold text-gray-400 uppercase tracking-wider" style="background-color: #2B3139">
                                            Retenido
                                        </th>
                                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider" style="background-color: #2B3139">
                                            Acción
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($fiats as $fiat)
                                    <tr class="hover:bg-oscurito">
                                        <td class="px-5 py-5 border-b border-gray-600 text-sm">
                                            <div class="flex items-center ">
                                                <div class="flex-shrink-0 w-10 h-10">
                                                    <img class="w-full h-full rounded-full" src="{{URL('/img/BTC.png')}}" alt="" />
                                                </div>
                                                <div class="ml-3">
                                                    <p class="text-gray-300 whitespace-no-wrap font-bold">
                                                        {{ $fiat->divisa }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-600  text-sm font-bold">
                                            <p class="text-gray-300 whitespace-no-wrap">{{ $fiat->cantidad }}</p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-600  text-sm font-bold">
                                            <p class="text-gray-300 whitespace-no-wrap">
                                                {{ $fiat->cantidad }}
                                            </p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-600 text-sm font-bold">
                                            <p class="text-gray-300 whitespace-no-wrap">
                                                0.00 €
                                            </p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-600  text-sm font-bold">
                                            <span class="relative inline-block px-3 py-1 font-semibold">
                                                <span aria-hidden class="absolute inset-0 rounded-full"></span>
                                                <button class="relative text-blue-500 px-2"><a href="/">Comprar </a></button>

                                                <span aria-hidden class="absolute inset-0 rounded-full"></span>
                                                <button class="relative text-blue-500 px-2"><a href="/">Retirar </a></button>
                                            </span>
                                        </td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                        <div class="text-sm text-gray-400 align-bottom py-2">
                            Cartera de criptomonedas
                        </div>
                        <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                            <table class="min-w-full leading-normal">
                                <thead>
                                    <tr>
                                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider" style="background-color: #2B3139">
                                            Moneda
                                        </th>
                                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider" style="background-color: #2B3139">
                                            Cantidad
                                        </th>
                                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider" style="background-color: #2B3139">
                                            Equivalente (€)
                                        </th>
                                        <th class="px-5 py-3  text-left text-xs font-semibold text-gray-400 uppercase tracking-wider" style="background-color: #2B3139">
                                            Retenido
                                        </th>
                                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider" style="background-color: #2B3139">
                                            Acción
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cryptos as $crypto)
                                    <tr class="hover:bg-oscurito">
                                        <td class="px-5 py-5 border-b border-gray-600 text-sm">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 w-10 h-10">
                                                    <img class="w-full h-full rounded-full" src="{{asset('img/'.$crypto->abr.'.png')}}" alt="" />
                                                </div>
                                                <div class="ml-3">
                                                    <p class="text-gray-300 whitespace-no-wrap text-m font-bold">
                                                        {{ $crypto->abr }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-600  text-m font-bold">
                                            <p class="text-gray-300 whitespace-no-wrap">{{ $crypto->cantidad }}</p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-600  text-m font-bold">
                                            <p class="text-gray-300 whitespace-no-wrap">
                                                {{ round($crypto->cantidad * $binance->precio($crypto->abr . 'EUR')['price'], 2) }}
                                            </p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-600 text-m font-bold">
                                            <p class="text-gray-300 whitespace-no-wrap">
                                                0.00 €
                                            </p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-600  text-m font-bold">
                                            <span class="relative inline-block px-3 py-1 font-semibold">
                                                <span aria-hidden class="absolute inset-0 rounded-full"></span>
                                                <button class="relative text-blue-500 px-2"><a href="/">Depositar </a></button>

                                                <span aria-hidden class="absolute inset-0 rounded-full"></span>
                                                <button class="relative text-blue-500 px-2"><a href="/">Retirar </a></button>

                                                <span aria-hidden class="absolute inset-0 rounded-full"></span>
                                                <button class="relative text-blue-500 px-2"><a href="/">Convertir </a></button>
                                            </span>
                                        </td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
    <div>
        <!-- aqui va lo demás -->
    </div>
    </div>

</x-app-layout>
