<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body>
        @livewireScripts()
        <nav class="bg-slate-700 px-4 p-4">
            <div class="flex items-center justify-between">

                <div class="flex items-center">
                    <div>
                        <img src="https://img.icons8.com/nolan/344/ethereum.png" style=" max-width:64px;
                        max-height:64px;" />
                    </div>

                    <div class="pl-5">
                        <a href="/comprar">Comprar crypto</a>
                    </div>
                </div>
                @if(!Auth::check())
                    <div>
                        <a href="/login">Iniciar Sesión</a>
                        <a href="/register">Registrarse</a>
                    </div>
                @else
                    <div>
                        <a href="/cartera">Cartera</a>
                        <div class="dropdown">
                            <button onclick="myFunction()" class="dropbtn">*Foto perfil*</button>
                            <div id="myDropdown" class="dropdown-content">
                              <a href="#">Perfil</a>
                              <a href="#">Cerrar sesión</a>
                            </div>
                          </div>
                    </div>
                    @endif
            </div>
            </div>
            </div>
        </nav>
        <main> {{$slot}} </main>
    </body>
</html>
