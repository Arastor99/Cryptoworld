<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Tinos&display=swap" rel="stylesheet">

  <!-- Styles -->
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">

  @livewireStyles
  <!-- Scripts -->
  <script src="{{ mix('js/app.js') }}" defer></script>
  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
</head>

<body>
  @livewireScripts()
  <!-- This example requires Tailwind CSS v2.0+ -->

  <nav class="px-2 bg-slate-700 p-3 text-white dark:bg-gray-800">
    <div class="container flex flex-wrap items-center justify-between mx-auto">
      <div class="flex items-center space-x-10">
        <a href="#" class="flex items-center">
          <!-- IMAGEN -->

          <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Cryptoworld</span>
        </a>
        <ul class="hidden md:flex flex-col mt-4 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium">
          <li>
            <a href="/" class="block px-4 py-2 hover:bg-slate-900 rounded-md" aria-current="page">Home</a>
          </li>

          <li>
            <a href="/comprar" class="block px-4 py-2 hover:bg-slate-900 rounded-md">Comprar crypto</a>
          </li>
          <li>
            <a href="/mercado" class="block px-4 py-2 hover:bg-slate-900 rounded-md">Mercado</a>
          </li>
          <li>
            <a href="#" class="block px-4 py-2 hover:bg-slate-900 rounded-md">Contact</a>
          </li>
        </ul>
      </div>
      <button data-collapse-toggle="mobile-menu" type="button" class="inline-flex items-center justify-center ml-3 rounded-lg md:hidden  focus:outline-none focus:ring-2" aria-controls="mobile-menu-2" aria-expanded="false">
        <span class="sr-only">Open main menu</span>
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
        </svg>
        <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
        </svg>
      </button>
      <div class="hidden w-full md:block md:w-auto" id="mobile-menu">
        <ul class="flex flex-col mt-4 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium">
          <li class="flex md:hidden">
            <a href="/" class="block px-4 py-2 hover:bg-slate-900" aria-current="page">Home</a>
          </li>

          <li class="flex md:hidden">
            <a href="/comprar" class="block px-4 py-2 hover:bg-slate-900">Comprar crypto</a>
          </li>
          <li class="flex md:hidden">
            <a href="/mercado" class="block px-4 py-2 hover:bg-slate-900">Mercado</a>
          </li>
          <li class="flex md:hidden">
            <a href="#" class="block px-4 py-2 hover:bg-slate-900">Contact</a>
          </li>
        @auth
            <li>
                <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar" class="">
                <a href="#">
                    <img class="h-10 w-10 rounded-full hover:scale-110 duration-150" src="{{Storage::disk('s3')->url($img[0]->profile_photo_path)}}" alt="profile">
                </a>
                </button>

                <div id="dropdownNavbar" class="z-10 hidden bg-slate-800 divide-y divide-gray-100 rounded shadow w-44 dark:bg-gray-700 dark:divide-gray-600" style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate(961px, 2186px);" data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="top">
                <ul class="py-1 text-sm dark" aria-labelledby="dropdownLargeButton">
                    <li>
                    <a href="/user/profile" class="block px-4 py-2 hover:bg-slate-900">Perfil</a>
                    </li>
                    <li>
                    <a href="/cartera" class="block px-4 py-2 hover:bg-slate-900">Cartera</a>
                    </li>
                    <li>
                        <a href="/cartera" class="block px-4 py-2 hover:bg-slate-900">Cartera</a>
                        </li>
                </ul>
                <div class="py-1">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <div class="nav-item">
                            <a class="block px-4 py-2 text-sm dark hover:bg-slate-900" href="{{ route('logout') }}" onclick="event.preventDefault();
                                        this.closest('form').submit(); " role="button">
                                <i class="fas fa-sign-out-alt"></i>

                                {{ __('Log Out') }}
                            </a>
                        </div>
                    </form>
                </div>
                </div>
            </li>
        @endauth
        @guest
            <li class="flex">
                <a href="/register" class="block px-4 py-2 hover:bg-slate-900">Registrarse</a>
            </li>
            <li class="flex">
                <a href="/login" class="block px-4 py-2 hover:bg-slate-900">Iniciar Sesión</a>
            </li>
        @endguest

        </ul>
      </div>
    </div>
  </nav>

  <main class="bg-oscurito"> {{$slot}} </main>
  <script src="https://unpkg.com/flowbite@1.4.7/dist/flowbite.js"></script>

  <footer class="footer relative pt-1 " style="background-color:#202124">
    <div class="container mx-auto px-6">

        <div class="sm:flex sm:mt-8">
            <div class="mt-8 sm:mt-0 sm:w-full sm:px-8 flex flex-col md:flex-row justify-between">
                <div class="flex flex-col">
                    <span class="font-bold text-white uppercase mb-2">Acerca de nosotros</span>
                    <span class="my-2"><a href="#" class="text-white  text-md hover:text-blue-500">Acerca de Cryptoworld</a></span>
                    <span class="my-2"><a href="#" class="text-white  text-md hover:text-blue-500">Blog</a></span>
                    <span class="my-2"><a href="#" class="text-white  text-md hover:text-blue-500">Declaración de divulgación de riesgos</a></span>
                </div>
                <div class="flex flex-col">
                    <span class="font-bold text-white uppercase mt-4 md:mt-0 mb-2">Contactanos</span>
                    <span class="my-2"><a href="#" class="text-white text-md hover:text-blue-500"><i class="fa-solid fa-envelope"></i> soporte@cryptoworld.com</a></span>
                    <span class="my-2"><a href="#" class="text-white  text-md hover:text-blue-500"><i class="fa-solid fa-location-dot"></i> C\ Alegria 8, Zaragoza</a></span>
                    <span class="my-2"><a href="#" class="text-white text-md hover:text-blue-500"></a><i class="fa-solid fa-phone"></i> +34 678529173</span>
                </div>
                <div class="flex flex-col">
                    <span class="font-bold text-white uppercase mt-4 md:mt-0 mb-2">Redes sociales</span>
                    <span class="my-2"><a href="#" class="text-white  text-md hover:text-blue-500"><i class="fa-brands fa-instagram"></i> Instagram</a></span>
                    <span class="my-2"><a href="#" class="text-white  text-md hover:text-blue-500"><i class="fa-brands fa-facebook"></i> Facebook</a></span>
                    <span class="my-2"><a href="#" class="text-white  text-md hover:text-blue-500"><i class="fa-brands fa-twitter"></i> Twitter</a></span>
                </div>
            </div>
        </div>
    </div>
    <div class="container mx-auto px-6">
        <div class="mt-16 flex flex-col items-center">
            <div class="sm:w-2/3 text-center py-6">
                <p class="text-sm text-blue-700 font-bold mb-2">
                </p>
            </div>
        </div>
    </div>
</footer>
</body>

</html>
