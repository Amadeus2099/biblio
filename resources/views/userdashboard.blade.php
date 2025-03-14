<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard del Usuario') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("¡Bienvenido! Estás autenticado.") }}
                </div>

                <!-- Botones de navegación -->
                <div class="flex justify-center mt-4">
                    <!-- Botón para ir a la vista de Perfil -->
                    <a href="{{ route('perfil') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-4">
                        Ir a Perfil
                    </a>

                    <!-- Botón para ir a la vista de Consulta y Préstamo -->
                    <a href="{{ route('prestamos') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        Consulta y Préstamo
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
