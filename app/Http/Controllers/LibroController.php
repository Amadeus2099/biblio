<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use Illuminate\Http\Request;

class LibroController extends Controller
{
    public function index()
    {
        if (auth()->user()->tipo !== 'admin') {
            abort(403, 'No tienes permiso para acceder a esta página.');
        }

        $libros = Libro::all();
        return view('indexLibro', compact('libros'));
    }

    public function create()
    {
        if (auth()->user()->tipo !== 'admin') {
            abort(403, 'Acceso no autorizado.');
        }

        return view('libros.create');
    }

    public function store(Request $request)
    {
        if (auth()->user()->tipo !== 'admin') {
            abort(403, 'Acceso no autorizado.');
        }

        $request->validate([
            'titulo' => ['required','string','max:255'],
            'autor' => ['required','string','max:255'],
            'editorial' => ['required','string','max:255'],
            'año' => ['required','digits:4'],
            'estado' => ['required','in:disponible,prestado'],
            'existencia' => ['required','integer','min:1'],
        ]);

        Libro::create($request->all());

        return redirect()->route('libros.index')->with('success', 'Libro agregado correctamente.');
    }

    public function edit(Libro $libro)
    {
        if (auth()->user()->tipo !== 'admin') {
            abort(403, 'Acceso no autorizado.');
        }

        return view('libros.edit', compact('libro'));
    }

    public function update(Request $request, Libro $libro)
    {
        if (auth()->user()->tipo !== 'admin') {
            abort(403, 'Acceso no autorizado.');
        }

        $request->validate([
            'titulo' => ['required','string','max:255'],
            'autor' => ['required','string','max:255'],
            'editorial' => ['required','string','max:255'],
            'año' => ['required','digits:4'],
            'estado' => ['required','in:disponible,prestado'],
            'existencia' => ['required','integer','min:1'],
        ]);

        $libro->update($request->all());

        return redirect()->route('libros.index')->with('success', 'Libro actualizado correctamente.');
    }

    public function destroy(Libro $libro)
    {
        if (auth()->user()->tipo !== 'admin') {
            abort(403, 'Acceso no autorizado.');
        }

        $libro->delete();

        return redirect()->route('libros.index')->with('success', 'Libro eliminado correctamente.');
    }
}
