<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = User::all();
        return view('user.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $usuarios = User::all();
        return view('user.create', compact('usuarios'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validar los datos según tu migración
    $request->validate([
        'nombre' => 'required|string|max:255',
        'apellido' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
        'rol' => 'required|in:admin,cliente',
        'telefono' => 'nullable|string|max:20',
        'domicilio' => 'nullable|string|max:500',
        'status' => 'required|in:activo,inactivo',
    ]);

    // 2. Crear el registro en la base de datos
    User::create([
        'nombre' => $request->nombre,
        'apellido' => $request->apellido,
        'email' => $request->email,
        'password' => Hash::make($request->password), // Encriptación obligatoria
        'rol' => $request->rol,
        'telefono' => $request->telefono,
        'domicilio' => $request->domicilio,
        'status' => $request->status,
    ]);

    // 3. Redireccionar con mensaje de éxito (con tu diseño de AdminLTE)
    return redirect()->route('usuarios.index')
                     ->with('status', '¡Usuario creado exitosamente!');
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
        $usuario = User::findOrFail($id);
        return view('user.edit', compact('usuario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $usuario = User::findOrFail($id);
        $usuario->update($request->all());

        return redirect()->route('usuarios.index')
                         ->with('status', 'Usuario actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $usuario = User::findOrFail($id);

        // Cambiamos el estado en lugar de borrarlo físicamente
        $usuario->status = 'inactivo';
        $usuario->save();

        return redirect()->route('usuarios.index')
                        ->with('status', 'El usuario ha sido desactivado correctamente.');
    }
}
