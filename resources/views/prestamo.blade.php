<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Préstamos de Libros') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if(auth()->user()->tipo === 'admin')

                    <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-200">Libros Prestados</h3>

                    <table class="min-w-full bg-white border border-gray-300 mb-6">
                        <thead>
                            <tr class="bg-gray-200 text-gray-700">
                                <th class="px-4 py-2 border">Usuario</th>
                                <th class="px-4 py-2 border">Libro</th>
                                <th class="px-4 py-2 border">Fecha Préstamo</th>
                                <th class="px-4 py-2 border">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($prestamosActivos as $prestamo)
                                <tr class="border">
                                    <td class="px-4 py-2">{{ $prestamo->usuario->name }} {{ $prestamo->usuario->apellido }}</td>
                                    <td class="px-4 py-2">{{ $prestamo->libro->titulo }}</td>
                                    <td class="px-4 py-2">{{ $prestamo->fecha_prestamo }}</td>
                                    <td class="px-4 py-2">
                                        <form action="{{ route('prestamos.devolver', $prestamo->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-lg">
                                                Marcar como Devuelto
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-200">Libros Devueltos</h3>

                    <table class="min-w-full bg-white border border-gray-300">
                        <thead>
                            <tr class="bg-gray-200 text-gray-700">
                                <th class="px-4 py-2 border">Usuario</th>
                                <th class="px-4 py-2 border">Libro</th>
                                <th class="px-4 py-2 border">Fecha Préstamo</th>
                                <th class="px-4 py-2 border">Fecha Entrega</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($prestamosDevueltos as $prestamo)
                                <tr class="border">
                                    <td class="px-4 py-2">{{ $prestamo->usuario->name }} {{ $prestamo->usuario->apellido }}</td>
                                    <td class="px-4 py-2">{{ $prestamo->libro->titulo }}</td>
                                    <td class="px-4 py-2">{{ $prestamo->fecha_prestamo }}</td>
                                    <td class="px-4 py-2">{{ $prestamo->fecha_entrega }}</td>
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
