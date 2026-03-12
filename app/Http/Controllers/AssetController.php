<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Pinata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;

class AssetController extends Controller
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
    public function create(Request $request)
    {
        $selected_id = $request->query('pinata_id');

        // Si hay un ID seleccionado, buscamos solo esa piñata, si no, todas para el select normal
        if ($selected_id) {
            $pinatas = Pinata::where('id', $selected_id)->get();
        } else {
            $pinatas = Pinata::all();
        }

        return view('asset.create', compact('pinatas', 'selected_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         //validación de campos requeridos
       $this->validate($request, [
           'title' => 'required|min:5',
           'pinata_id' => 'required|exists:pinatas,id',
           'image' => 'required|mimes:jpg,jpeg,png,gif',
           'video_path' => 'required|mimes:mp4'
       ]);


       $asset = new Asset();
       $asset->title = $request->input('title');
       $asset->pinata_id = $request->input('pinata_id');

       //Subida de la miniatura
       $image = $request->file('image');
       if ($image) {
           $image_path = time() . '_' . $image->getClientOriginalName();
           Storage::disk('images')->put($image_path, File::get($image));
           $asset->image = $image_path;
       }
       //Subida del video
       $video_file = $request->file('video_path');
       if ($video_file) {
           $video_path = time() . '_' . $video_file->getClientOriginalName();
           Storage::disk('videos')->put($video_path, File::get($video_file));
           $asset->video_path = $video_path;
       }
       $asset->save();

       if ($image && $asset->id) {
        // Buscamos la piñata relacionada por el ID fijo que capturamos antes
        $pinata = Pinata::find($asset->pinata_id);

        if ($pinata) {
                // Guardamos la referencia: asset/getImage/{nombre_archivo}
                $pinata->imagen_url = 'asset/getImage/' . $asset->image;
                $pinata->save(); // Guardamos el cambio en MySQL
            }
        }

       return redirect()->route('pinatas.index')->with(array(
           'message' => 'El video demostrativo de la piñata se ha subido correctamente'
       ));

    }

    public function getImage($filename)
    {
        // Verificamos si el archivo existe en el disco 'images' que configuramos en filesystems.php
        if (!Storage::disk('images')->exists($filename)) {
            abort(404);
        }

        $file = Storage::disk('images')->get($filename);

        // Obtenemos el tipo de archivo (jpeg, png, etc.) para que el navegador lo interprete bien
        $type = Storage::disk('images')->mimeType($filename);
        return response($file, 200)->header('Content-Type', $type);
    }

    public function getVideo($filename)
    {
        if (!Storage::disk('videos')->exists($filename)) {
        abort(404);
        }

        $file = Storage::disk('videos')->get($filename);

        // Es vital pasar el Content-Type 'video/mp4' para que el reproductor de HTML5 funcione
        $type = Storage::disk('videos')->mimeType($filename);
        return response($file, 200)->header('Content-Type', $type);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $asset = Asset::findOrFail($id);
        return view('asset.show', compact('asset'));
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
        $asset = Asset::findOrFail($id);

        // 1. Borramos los archivos físicos de los discos correspondientes
        if ($asset->image) {
            Storage::disk('images')->delete($asset->image);
        }
        if ($asset->video_path) {
            Storage::disk('videos')->delete($asset->video_path);
        }

        // 2. IMPORTANTE: Limpiar la referencia en la tabla de Piñatas
        $pinata = \App\Models\Pinata::find($asset->pinata_id);
        if ($pinata) {
            $pinata->imagen_url = null; // Dejamos la piñata sin imagen referenciada
            $pinata->save();
        }

        // 3. Borramos el registro de la base de datos
        $asset->delete();

        return redirect()->route('pinatas.index')->with('message', 'Multimedia eliminada y catálogo actualizado correctamente 🍍');
    }

}
