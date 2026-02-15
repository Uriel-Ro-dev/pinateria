<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;


class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Filtramos solo las categorías donde activo sea 1
        $categorias = Categoria::where('activo', 1)->get();

        // Retornamos la vista dentro de tu carpeta 'categoria'
        return view('categoria.index', compact('categorias'));
    }

    private function cargarDT($consulta)
    {
        $categoriasDT = [];

        foreach ($consulta as $key => $value) {
            // Generamos la ruta de edición para la categoría
            $actualizar = route('categorias.edit', $value['id']);

            // HTML de acciones: Editar y el botón que activa el Modal de borrado
            $acciones = '
                <div class="btn-group" role="group">
                    <a href="' . $actualizar . '" class="btn btn-warning btn-sm" title="Editar">
                        <i class="fas fa-edit"></i>
                    </a>
                    <button type="button" class="btn btn-danger btn-sm"
                        onclick="confirmarBorradoCat(\'' . $value['id'] . '\', \'' . $value['nombre'] . '\')"
                        data-toggle="modal" data-target="#deleteCatModal">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>';

            // Lógica para mostrar el estado como badge
            $estado = ($value['activo'] == 1)
                ? '<span class="badge badge-success">Activa</span>'
                : '<span class="badge badge-danger">Inactiva</span>';

            // Estructura del array para el DataTable de Categorías
            $categoriasDT[$key] = array(
                $acciones,
                $value['id'],
                $value['nombre'],
                $value['descripcion'] ?? 'Sin descripción',
                $estado
            );
        }

        return $categoriasDT;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('categoria.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
        'nombre' => 'required|min:3|unique:categorias',
        'descripcion' => 'nullable'
        ]);

        $categoria = new Categoria();
        $categoria->nombre = $request->input('nombre');
        $categoria->descripcion = $request->input('descripcion');
        $categoria->activo = true;
        $categoria->save();

        return redirect()->route('categorias.index')->with([
            'message' => 'Categoría creada con éxito'
        ]);
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
        $categoria = Categoria::findOrFail($id);
        return view('categoria.edit', array(
            'categoria'=>$categoria
   ));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // 1. Validamos los campos específicos de tu categoría
        $this->validate($request, [
            'nombre'      => 'required|min:3|max:255',
            'descripcion' => 'nullable|string'
        ]);

        // 2. Buscamos la categoría por ID
        $categoria = Categoria::findOrFail($id);

        // 3. Asignamos los valores del formulario
        $categoria->nombre      = $request->input('nombre');
        $categoria->descripcion = $request->input('descripcion');

        // 4. Guardamos los cambios
        $categoria->save();

        // 5. Redireccionamos a la lista de categorías
        return redirect()->route('categorias.index')->with(array(
            'message' => 'La categoría se ha actualizado correctamente'
        ));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // 1. Buscamos la categoría por ID
        $categoria = Categoria::find($id);

        // 2. Verificamos si existe antes de proceder
        if ($categoria) {
            // 3. Cambiamos el valor a 0 (Inactivo) según tu base de datos tinyint(1)
            $categoria->activo = 0;
            $categoria->update();

            // 4. Redireccionamos con mensaje de éxito
            return redirect()->route('categorias.index')->with("message", "La categoría se ha desactivado correctamente");
        } else {
            // 5. En caso de que no se encuentre el registro
            return redirect()->route('categorias.index')->with("message", "La categoría que trata de eliminar no existe");
        }
    }
}
