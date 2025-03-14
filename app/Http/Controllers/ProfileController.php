<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Mostrar el formulario de edición de perfil.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();

        if (Auth::user()->tipo !== 'admin' && Auth::id() !== $user->id) {
            abort(403, 'No tienes permiso para acceder a este perfil.');
        }

        return view('profile.edit', compact('user'));
    }

    /**
     * Actualizar la información del perfil.
     */
    public function update(ProfileUpdateRequest $request, $id = null): RedirectResponse
    {
        $user = $id ? User::findOrFail($id) : $request->user();

        if (Auth::user()->tipo !== 'admin' && Auth::id() !== $user->id) {
            abort(403, 'No tienes permisos para actualizar este perfil.');
        }

        // Validar datos y evitar que usuarios normales cambien su tipo
        $validatedData = $request->validated();
        if (Auth::user()->tipo !== 'admin') {
            unset($validatedData['tipo']); 
        }

        $user->update($validatedData);

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Eliminar un usuario (solo admin).
     */
    public function destroy($id)
    {
        if (auth()->user()->tipo !== 'admin') {
            abort(403, 'No tienes permisos para eliminar usuarios.');
        }

        $usuario = User::find($id);

        if (!$usuario) {
            return redirect()->route('usuarios.index')->with('error', 'Usuario no encontrado.');
        }

        if ($usuario->tipo === 'admin') {
            return redirect()->route('usuarios.index')->with('error', 'No puedes eliminar otro administrador.');
        }

       
    }
}
