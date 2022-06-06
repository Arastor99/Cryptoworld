<x-app-layout>
    <br>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Crypto
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Cantidad
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Valor (€)
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Operaciones
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cryptos as $crypto)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                        {{$crypto->abr}}
                    </th>
                    <td class="px-6 py-4">
                        {{$crypto->cantidad}}
                    </td>
                    <td class="px-6 py-4">
                      {{$crypto->cantidad * ($binance->precio($crypto->abr . 'EUR'))['price']}} €
                    </td>
                    <td class="px-6 py-4">
                        <a href="/cartera/vender" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Vender</a>
                        <a href="/cartera/enviar" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Enviar</a>
                        <a href="/cartera/recibir" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Recibir</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Divisa
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Cantidad
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Valor (€)
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Operaciones
                    </th>
                </tr>
            </thead>
            <br>
            <tbody>
                @foreach ($fiats as $fiat)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                        {{$fiat->divisa}}
                    </th>
                    <td class="px-6 py-4">
                        {{$fiat->cantidad}}
                    </td>
                    <td class="px-6 py-4">
                        {{$fiat->cantidad}} €
                    </td>
                    <td class="px-6 py-4">
                        <a href="/comprar" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Comprar</a>
                        <a href="/retirar" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Retirar</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
