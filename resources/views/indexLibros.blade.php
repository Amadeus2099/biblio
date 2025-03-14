<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gestión de Libros') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if(auth()->user()->tipo === 'admin')
                    <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-200">Lista de Libros</h3>

                    <!-- Botón para agregar nuevo libro -->
                    <a href="{{ route('libros.create') }}" class="mb-4 inline-block px-4 py-2 bg-green-500 text-white rounded-lg">Agregar Libro</a>

                    <table class="min-w-full bg-white border border-gray-300">
                        <thead>
                            <tr class="bg-gray-200 text-gray-700">
                                <th class="px-4 py-2 border">Título</th>
                                <th class="px-4 py-2 border">Autor</th>
                                <th class="px-4 py-2 border">Editorial</th>
                                <th class="px-4 py-2 border">Año</th>
                                <th class="px-4 py-2 border">Estado</th>
                                <th class="px-4 py-2 border">Existencia</th>
                                <th class="px-4 py-2 border">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($libros as $libro)
                                <tr class="border">
                                    <td class="px-4 py-2">{{ $libro->titulo }}</td>
                                    <td class="px-4 py-2">{{ $libro->autor }}</td>
                                    <td class="px-4 py-2">{{ $libro->editorial }}</td>
                                    <td class="px-4 py-2">{{ $libro->año }}</td>
                                    <td class="px-4 py-2">{{ ucfirst($libro->estado) }}</td>
                                    <td class="px-4 py-2">{{ $libro->existencia }}</td>
                                    <td class="px-4 py-2">
                                        <a href="{{ route('libros.edit', $libro->id) }}" class="text-blue-500">Editar</a>
                                        <form action="{{ route('libros.destroy', $libro->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 ml-2" onclick="return confirm('¿Seguro que quieres eliminar este libro?')">
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
