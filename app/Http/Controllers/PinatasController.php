<?php

namespace App\Http\Controllers;

use App\Models\pinata;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PinatasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::all(); // Traemos todas las categorías de la BD
        return view('pinateria.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validación de campos requeridos
        $this->validate($request, [
        'nombre' => 'required|min:5',
        'tamano' => 'required',
        'precio' => 'required|numeric',
        'stock' => 'required|integer',
        'material' => 'required',
        'categoria_id' => 'required',
        'imagen_url' => 'required',
        ]);


        $pinata = new Pinata();
        $pinata->nombre = $request->input('nombre');
        $pinata->tamano = $request->input('tamano');
        $pinata->precio = $request->input('precio');
        $pinata->stock = $request->input('stock');
        $pinata->material = $request->input('material');
        $pinata->categoria_id = $request->input('categoria_id');
        $pinata->imagen_url = $request->input('imagen_url');
        $pinata->activo = true;
        $pinata->save();
        return redirect()->route('pinatas.index')->with(array(
        'message' => 'La piñata se ha guardado correctamente'
        ));
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
        //
    }
}
