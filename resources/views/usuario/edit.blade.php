<x-app-layout>

    <form action="{{url('/usuarios/'.$usuario->id)}}" method="post" class="p-10 bg-[#202124]">
        @csrf
        @method('PATCH')
        <div class="relative z-0 w-full mb-6 group">
            <input type="text" name="nombre" class="block py-2.5 px-0 w-full text-md text-gray-400 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" value={{$informacionUsuario[0]->nombre}} placeholder=" " required />
            <label for="nombre" class="peer-focus:font-medium absolute text-md text-gray-200 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nombre</label>
        </div>
        <div class="relative z-0 w-full mb-6 group">
            <input type="text" name="apellidos" id="apellidos" class="block py-2.5 px-0 w-full text-md text-gray-400 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" value={{$informacionUsuario[0]->apellidos}} placeholder=" " required />
            <label for="apellidos" class="peer-focus:font-medium absolute text-md text-gray-200 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Apellidos</label>
        </div>
        <div class="relative z-0 w-full mb-6 group">
            <input type="text" name="email" id="email" class="block py-2.5 px-0 w-full text-md text-gray-400 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" value={{$informacionUsuario[0]->email}} placeholder=" " required />
            <label for="email" class="peer-focus:font-medium absolute text-md text-gray-200 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email</label>
        </div>
        <div class="grid xl:grid-cols-2 xl:gap-6">
          <div class="relative z-0 w-full mb-6 group">
              <input type="text" name="nickname" id="nickname" class="block py-2.5 px-0 w-full text-md text-gray-400 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" value={{$informacionUsuario[0]->nickname}} placeholder=" " required />
              <label for="nickname" class="peer-focus:font-medium absolute text-md text-gray-200 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nombre de usuario</label>
          </div>
          <div class="relative z-0 w-full mb-6 group">
              <input type="text" name="BTC" id="BTC" class="block py-2.5 px-0 w-full text-md text-gray-400 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" value={{$informacionUsuario[0]->cantidad}} placeholder=" " required />
              <label for="BTC" class="peer-focus:font-medium absolute text-md text-gray-200 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">BTC</label>
          </div>
        </div>
        <div class="grid xl:grid-cols-2 xl:gap-6">
          <div class="relative z-0 w-full mb-6 group">
              <input type="text" name="ETH" id="ETH" class="block py-2.5 px-0 w-full text-md text-gray-400 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" value={{$informacionUsuario[1]->cantidad}} placeholder=" " required />
              <label for="ETH" class="peer-focus:font-medium absolute text-md text-gray-200 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">ETH</label>
          </div>
          <div class="relative z-0 w-full mb-6 group">
              <input type="text" name="ADA" id="ADA" class="block py-2.5 px-0 w-full text-md text-gray-400 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" value={{$informacionUsuario[2]->cantidad}} placeholder=" " required />
              <label for="ADA" class="peer-focus:font-medium absolute text-md text-gray-200 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">ADA</label>
          </div>
          <div class="relative z-0 w-full mb-6 group">
            <input type="text" name="BNB" id="BNB" class="block py-2.5 px-0 w-full text-md text-gray-400 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" value={{$informacionUsuario[3]->cantidad}} placeholder=" " required />
            <label for="BNB" class="peer-focus:font-medium absolute text-md text-gray-200 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">BNB</label>
        </div>
        <div class="relative z-0 w-full mb-6 group">
            <input type="text" name="EUR" id="EUR" class="block py-2.5 px-0 w-full text-md text-gray-400 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" value={{$dineroUsuario[0]->cantidad}} placeholder=" " required />
            <label for="EUR" class="peer-focus:font-medium absolute text-md text-gray-200 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Euros</label>
        </div>
        </div>
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-md w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Actualizar</button>
      </form>
</x-app-layout>
