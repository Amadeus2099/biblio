<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gestión de Usuarios') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                @if(auth()->user()->tipo === 'admin')
                    <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-200">Lista de Usuarios</h3>

                    <table class="min-w-full bg-white border border-gray-300">
                        <thead>
                            <tr class="bg-gray-200 text-gray-700">
                                <th class="px-4 py-2 border">Nombre</th>
                                <th class="px-4 py-2 border">Apellido</th>
                                <th class="px-4 py-2 border">Teléfono</th>
                                <th class="px-4 py-2 border">Correo</th>
                                <th class="px-4 py-2 border">Tipo</th>
                                <th class="px-4 py-2 border">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usuarios as $usuario)
                                <tr class="border">
                                    <td class="px-4 py-2">{{ $usuario->name }}</td>
                                    <td class="px-4 py-2">{{ $usuario->apellido }}</td>
                                    <td class="px-4 py-2">{{ $usuario->telefono }}</td>
                                    <td class="px-4 py-2">{{ $usuario->email }}</td>
                                    <td class="px-4 py-2">{{ $usuario->tipo }}</td>
                                    <td class="px-4 py-2">
                                        <a href="{{ route('admin.profile.edit', $usuario->id) }}" class="text-blue-500">Editar</a>
                                        <form action="{{ route('admin.profile.destroy', $usuario->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 ml-2" onclick="return confirm('¿Seguro que quieres eliminar este usuario?')">
                                                Eliminar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-center text-red-500 font-semibold">No tienes permiso para acceder a esta página.</p>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
