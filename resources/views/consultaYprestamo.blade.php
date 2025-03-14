<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Consulta y Préstamo de Libros') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-200">Lista de Libros Disponibles</h3>

                <!-- Mostrar el número de préstamos actuales -->
                <p class="mb-4 text-gray-700">
                    Préstamos activos: <strong>{{ $prestamosActivos }}/3</strong>
                </p>

                <table class="min-w-full bg-white border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200 text-gray-700">
                            <th class="px-4 py-2 border">Título</th>
                            <th class="px-4 py-2 border">Autor</th>
                            <th class="px-4 py-2 border">Editorial</th>
                            <th class="px-4 py-2 border">Año</th>
                            <th class="px-4 py-2 border">Estado</th>
                            <th class="px-4 py-2 border">Existencia</th>
                            <th class="px-4 py-2 border">Acción</th>
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
                                    @if ($prestamosActivos < 3 && $libro->existencia > 0)
                                        <form action="{{ route('prestamos.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="libro_id" value="{{ $libro->id }}">
                                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg">
                                                Prestar
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-red-500">No disponible</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>
