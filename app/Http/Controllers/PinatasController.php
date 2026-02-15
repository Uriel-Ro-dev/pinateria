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
        // Filtramos solo las piñatas donde activo sea 1 (tinyint)
        $pinatas = pinata::where('activo', 1)->get();

        // Retornamos la vista dentro de tu carpeta 'pinateria'
        return view('pinateria.index', compact('pinatas'));
    }

    private function cargarDT($consulta)
    {
        $pinatasDT = [];

        foreach ($consulta as $key => $value) {
            // Generamos la ruta de edición para la piñata actual
            $actualizar = route('pinatas.edit', $value['id']);

            // Construimos el HTML de las acciones (Editar y Eliminar)
            // Nota: El botón de eliminar llama a la función modal() de JS que pusimos en el index
            $acciones = '
                <div class="btn-group" role="group">
                    <a href="' . $actualizar . '" class="btn btn-warning btn-sm" title="Editar">
                        <i class="fas fa-edit"></i>
                    </a>
                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmarBorrado(\'' . $value['id'] . '\', \'' . $value['nombre'] . '\')" data-toggle="modal" data-target="#deleteModal">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>';

            // Definimos el estatus con un badge visual
            $estado = ($value['activo'] == 1)
                ? '<span class="badge badge-success">Activo</span>'
                : '<span class="badge badge-danger">Inactivo</span>';

            // Estructuramos el arreglo con las columnas de tu tabla de piñatas
            $pinatasDT[$key] = array(
                $acciones,
                $value['id'],
                $value['nombre'],
                '$' . number_format($value['precio'], 2),
                $value['stock'],
                $value['tamano'],
                $estado
            );
        }

        return $pinatasDT;
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
        //Abre el formulario que permita editar un registro
        $pinata = Pinata::findOrFail($id);
        $categorias = Categoria::all();
        return view('pinateria.edit', compact('pinata', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // 1. Validar la información basada en tus campos de piñatas
        $this->validate($request, [
            'nombre'       => 'required|min:3',
            'tamano'       => 'nullable|string',
            'precio'       => 'required|numeric|min:0',
            'stock'        => 'required|integer|min:0',
            'material'     => 'nullable|string',
            'categoria_id' => 'required|exists:categorias,id', // Verifica que la categoría exista
            'imagen_url'   => 'nullable|string'
        ]);

        // 2. Buscar la piñata por ID usando el modelo correcto
        $pinata = Pinata::findOrFail($id);

        // 3. Asignar los nuevos valores desde el request
        $pinata->nombre       = $request->input('nombre');
        $pinata->tamano       = $request->input('tamano');
        $pinata->precio       = $request->input('precio');
        $pinata->stock        = $request->input('stock');
        $pinata->material     = $request->input('material');
        $pinata->categoria_id = $request->input('categoria_id');
        $pinata->imagen_url   = $request->input('imagen_url');

        // 4. Guardar los cambios en la base de datos
        $pinata->save();

        // 5. Redireccionar con un mensaje de éxito
        return redirect()->route('pinatas.index')->with(array(
            'message' => 'La piñata se ha actualizado correctamente'
        ));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // 1. Buscamos la piñata por su ID
        $pinata = Pinata::find($id);

        // 2. Verificamos si existe antes de intentar modificarla
        if ($pinata) {
            // 3. Cambiamos el estatus a 0 (Inactivo) en lugar de eliminar el registro
            $pinata->activo = 0;
            $pinata->update();

            // 4. Redireccionamos con mensaje de éxito
            return redirect()->route('pinatas.index')->with("message", "La piñata se ha desactivado correctamente");
        } else {
            // 5. Manejo de error si el ID no existe
            return redirect()->route('pinatas.index')->with("message", "La piñata que trata de eliminar no existe");
        }
    }
}
