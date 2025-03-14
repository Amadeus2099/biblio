<?php

namespace App\Http\Controllers;

use App\Models\Prestamo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrestamoController extends Controller
{
    public function index()
    {
        // Obtener todos los préstamos y enviarlos a la vista
        $prestamos = Prestamo::all();
        return view('prestamos.index', compact('prestamos'));
    }
    public function adminIndex()
    {
        if (auth()->user()->tipo !== 'admin') {
            abort(403, 'No tienes permiso para acceder a esta página.');
        }

        // Obtener préstamos activos (sin fecha de entrega)
        $prestamosActivos = Prestamo::whereNull('fecha_entrega')->with('usuario', 'libro')->get();

        // Obtener préstamos devueltos (con fecha de entrega)
        $prestamosDevueltos = Prestamo::whereNotNull('fecha_entrega')->with('usuario', 'libro')->get();

        return view('prestamo', compact('prestamosActivos', 'prestamosDevueltos'));
    }

    public function devolver($id)
    {
        if (auth()->user()->tipo !== 'admin') {
            abort(403, 'Acceso no autorizado.');
        }

        $prestamo = Prestamo::findOrFail($id);

        // Marcar préstamo como devuelto
        $prestamo->update(['fecha_entrega' => now()]);

        // Aumentar la existencia del libro
        $prestamo->libro->increment('existencia');

        return redirect()->route('prestamos.admin')->with('success', 'Libro marcado como devuelto.');
    }
}
