<x-app-layout>
    <div class="flex flex-col items-center mt-4">
        <h1 class="mb-4 text-2xl font-semibold">Usuarios</h1>
        <div class="border border-gray-700 shadow">
            <table>
                <thead class="bg-gray-900">
                    <tr>
                        <th class="px-6 py-2 text-xs text-gray-500">
                            Foto
                        </th>
                        <th class="px-6 py-2 text-xs text-gray-500">
                            Nombre de usuario
                        </th>
                        <th class="px-6 py-2 text-xs text-gray-500">
                            Editar
                        </th>
                        <th class="px-6 py-2 text-xs text-gray-500">
                            Borrar
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-gray-700">
                    @foreach ($datos as $dato)
                        <tr class="whitespace-nowrap">
                            <td>
                                <img class="h-10 w-10 rounded-full ml-4 " src="{{Storage::disk('s3')->url($img[0]->profile_photo_path)}}" alt="profile">
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">
                                    <a href="/usuario/{{ $dato->id }}" class="text-blue-500 hover:underline">
                                        {{ $dato->nickname }}
                                    </a>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <a href={{url('/usuarios/'.$dato->id.'/edit')}}
                                    class="px-4 py-1 text-sm text-white bg-blue-400 rounded">Editar</a>
                            </td>
                            <td class="px-6 py-4">
                                <form action="/usuario/{{ $dato->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('¿Seguro?')" class="px-4 py-1 text-sm text-white bg-red-400 rounded" type="submit">Borrar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
