<x-app-layout>
<form action="{{ route('usuario.update', $usuario->id, false) }}" method="POST">
    @method('PUT')
    <x-emple.form
        :usuario="$usuario" />
</form>
</x-app-layout>
