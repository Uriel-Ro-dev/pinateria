<?php

namespace App\Http\Controllers;

use App\Models\Resena;
use App\Models\Compras;
use Illuminate\Http\Request;

class ResenaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $resenas = Resena::with(['cliente', 'pinata'])->get();
        return view('resenas.index', compact('resenas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $compras = Compras::where('usuario_id', auth()->id())
                ->with('detalles.pinata')
                ->get();

        return view('resenaForm', compact('compras'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'estrellas' => 'required|integer|min:1|max:5',
            'comentario' => 'required|string|max:500',
            'pinata_id' => 'required|exists:pinatas,id',
        ]);

            Resena::create([
            'estrellas' => $request->estrellas,
            'comentario' => $request->comentario,
            'fecha' => now(),
            'usuario_id' => auth()->id(),
            'pinata_id' => $request->pinata_id,
        ]);

        return back()->with('status', '¡Gracias por calificar tu piñata! 🍍');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Resena::destroy($id);
        return redirect()->route('resenas.index')
                         ->with('status', 'Reseña eliminada correctamente.');
    }
}
