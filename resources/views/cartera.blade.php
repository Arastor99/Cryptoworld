<x-app-layout>
    <link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/styles/tailwind.css">
    <link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>

    <body style="background-color: #121212">
        <div class="w-full mb-12 px-4">
            <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded
   text-white"
                style="background-color: #202124">
                <div class="rounded-t mb-0 px-4 py-3 border-0">
                    <div class="flex flex-wrap items-center">
                        <div class="relative w-full px-4 max-w-full flex-grow flex-1 ">
                            <h3 class="font-semibold text-lg text-white"></h3>
                        </div>
                    </div>
                </div>
                <div class="block w-full overflow-x-auto ">
                    <table class="items-center w-full bg-transparent border-collapse">
                        <thead>
                            <tr>
                                <th class="px-6 align-middle border border-solid py-3 text-s uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left text-white"
                                    style="background-color: #202124">
                                    Crypto</th>
                                <th
                                    class="px-6 align-middle border border-solid py-3 text-s uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left text-white">
                                    Cantidad</th>
                                <th
                                    class="px-6 align-middle border border-solid py-3 text-s uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left text-white">
                                    Retenido</th>
                                <th
                                    class="px-6 align-middle border border-solid py-3 text-s uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left text-white">
                                    Equivalente (€)</th>
                                <th
                                    class="px-6 align-middle border border-solid py-3 text-s uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left text-white">
                                    Operaciones </th>
                                <th
                                    class="px-6 align-middle border border-solid py-3 text-s uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left text-white">
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($cryptos as $crypto)
                                <tr>
                                    <th
                                        class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left flex items-center">
                                        <img src="https://demos.creative-tim.com/notus-js/assets/img/bootstrap.jpg"
                                            class="h-12 w-12 bg-white rounded-full border" alt="...">
                                        <span class="ml-3 font-bold text-white"> {{ $crypto->abr }} </span>
                                    </th>
                                    <td
                                        class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                        {{ $crypto->cantidad }}</td>
                                    <td
                                        class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                        <i class="fas fa-circle text-red-500 mr-2"></i>0.00 €
                                    </td>
                                    <td
                                        class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                        <div class="flex">
                                            {{ round($crypto->cantidad * $binance->precio($crypto->abr . 'EUR')['price'], 2) }}
                                            €
                                        </div>
                                    </td>
                                    <td
                                        class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                        <div class="flex items-center">
                                            <a href="#" class="text-gray-400 hover:text-gray-100 mr-2">
                                                Recibir
                                            </a>
                                            <a href="#" class="text-gray-400 hover:text-gray-100  mx-2">
                                                Enviar
                                            </a>
                                            <a href="#" class="text-gray-400 hover:text-gray-100  ml-2">
                                                Convertir
                                            </a>
                                        </div>
                </div>
                </td>
                <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-right">
                </td>
                </tr>
                @endforeach
                </tbody>
                </table>
            </div>
        </div>
        </div>



        <div class="w-full mb-12 px-4">
            <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded
   text-white"
                style="background-color: #202124">
                <div class="rounded-t mb-0 px-4 py-3 border-0">
                    <div class="flex flex-wrap items-center">
                        <div class="relative w-full px-4 max-w-full flex-grow flex-1 ">
                            <h3 class="font-semibold text-lg text-white"></h3>
                        </div>
                    </div>
                </div>
                <div class="block w-full overflow-x-auto ">
                    <table class="items-center w-full bg-transparent border-collapse">
                        <thead>
                            <tr>
                                <th class="px-6 align-middle border border-solid py-3 text-s uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left text-white"
                                    style="background-color: #202124">
                                    Divisa</th>
                                <th
                                    class="px-6 align-middle border border-solid py-3 text-s uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left text-white">
                                    Cantidad</th>
                                <th
                                    class="px-6 align-middle border border-solid py-3 text-s uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left text-white">
                                    Retenido</th>
                                <th
                                    class="px-6 align-middle border border-solid py-3 text-s uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left text-white">
                                    Equivalente (€)</th>
                                <th
                                    class="px-6 align-middle border border-solid py-3 text-s uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left text-white">
                                    Operaciones </th>
                                <th
                                    class="px-6 align-middle border border-solid py-3 text-s uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left text-white">
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($fiats as $fiat)
                                <tr>
                                    <th
                                        class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left flex items-center">
                                        <img src="https://demos.creative-tim.com/notus-js/assets/img/bootstrap.jpg"
                                            class="h-12 w-12 bg-white rounded-full border" alt="...">
                                        <span class="ml-3 font-bold text-white"> {{ $fiat->divisa }} </span>
                                    </th>
                                    <td
                                        class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                        {{ $fiat->cantidad }}</td>
                                    <td
                                        class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                        <i class="fas fa-circle text-red-500 mr-2"></i>0.00 €
                                    </td>
                                    <td
                                        class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                        <div class="flex">
                                            {{ $fiat->cantidad }}€
                                        </div>
                                    </td>
                                    <td
                                        class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                        <div class="flex items-center">
                                            <a href="#" class="text-gray-400 hover:text-gray-100 mr-2">
                                                Comprar
                                            </a>
                                            <a href="#" class="text-gray-400 hover:text-gray-100  mx-2">
                                                Retirar
                                            </a>
                                        </div>
                </div>
                </td>
                <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-right">
                </td>
                </tr>
                @endforeach
                </tbody>
                </table>
            </div>
        </div>
        </div>
    </body>
    <footer class="footer relative pt-1 border-b-2 top-[22vh]" style="background-color:#202124">
        <div class="container mx-auto px-6">

            <div class="sm:flex sm:mt-8">
                <div class="mt-8 sm:mt-0 sm:w-full sm:px-8 flex flex-col md:flex-row justify-between">
                    <div class="flex flex-col">
                        <span class="font-bold text-white uppercase mb-2">Acerca de nosotros</span>
                        <span class="my-2"><a href="#" class="text-white  text-md hover:text-blue-500">Acerca
                                de Cryptoworld</a></span>
                        <span class="my-2"><a href="#"
                                class="text-white  text-md hover:text-blue-500">Blog</a></span>
                        <span class="my-2"><a href="#"
                                class="text-white  text-md hover:text-blue-500">Declaración de divulgación de
                                riesgos</a></span>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-bold text-white uppercase mt-4 md:mt-0 mb-2">Contactanos</span>
                        <span class="my-2"><a href="#" class="text-white text-md hover:text-blue-500"><i
                                    class="fa-solid fa-envelope"></i> soporte@cryptoworld.com</a></span>
                        <span class="my-2"><a href="#" class="text-white  text-md hover:text-blue-500"><i
                                    class="fa-solid fa-location-dot"></i> C\ Alegria 8, Zaragoza</a></span>
                        <span class="my-2"><a href="#" class="text-white text-md hover:text-blue-500"></a><i
                                class="fa-solid fa-phone"></i> +34 678529173</span>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-bold text-white uppercase mt-4 md:mt-0 mb-2">Redes sociales</span>
                        <span class="my-2"><a href="#" class="text-white  text-md hover:text-blue-500"><i
                                    class="fa-brands fa-instagram"></i> Instagram</a></span>
                        <span class="my-2"><a href="#" class="text-white  text-md hover:text-blue-500"><i
                                    class="fa-brands fa-facebook"></i> Facebook</a></span>
                        <span class="my-2"><a href="#" class="text-white  text-md hover:text-blue-500"><i
                                    class="fa-brands fa-twitter"></i> Twitter</a></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mx-auto px-6">
            <div class="mt-16 border-t-2 border-gray-300 flex flex-col items-center">
                <div class="sm:w-2/3 text-center py-6">
                    <p class="text-sm text-blue-700 font-bold mb-2">
                    </p>
                </div>
            </div>
        </div>
    </footer>
</x-app-layout>
