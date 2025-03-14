<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Perfil') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form method="POST" action="{{ route('profile.update', $user->id) }}">
                    @csrf
                    @method('PATCH')

                    <div class="mb-4">
                        <label class="block text-gray-700">Nombre</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full border-gray-300 rounded-lg">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Apellido</label>
                        <input type="text" name="apellido" value="{{ old('apellido', $user->apellido) }}" class="w-full border-gray-300 rounded-lg">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Teléfono</label>
                        <input type="text" name="telefono" value="{{ old('telefono', $user->telefono) }}" class="w-full border-gray-300 rounded-lg">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Correo Electrónico</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border-gray-300 rounded-lg">
                    </div>

                    @if(auth()->user()->tipo === 'admin')
                        <div class="mb-4">
                            <label class="block text-gray-700">Tipo de Usuario</label>
                            <select name="tipo" class="w-full border-gray-300 rounded-lg">
                                <option value="usuario" {{ $user->tipo === 'usuario' ? 'selected' : '' }}>Usuario</option>
                                <option value="admin" {{ $user->tipo === 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                        </div>
                    @endif

                    <div class="flex justify-end">
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg">Actualizar</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
