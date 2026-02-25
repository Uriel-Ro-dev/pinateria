<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;
use Carbon\Carbon;
use App\Models\pinata;
use App\Models\User;

class GeneradorController extends Controller
{

    public function imprimirInventario()
    {
        // Obtenemos las piñatas con estatus 1 (activas/disponibles)
        $pinatas = pinata::where('activo', '1')->get();

        $today = Carbon::now()->format('d/m/Y');

        // Cargamos la vista 'reporte_pinatas' y le pasamos la variable
        $pdf = Pdf::loadView('pinateria.inventarioPinatas', compact('pinatas', 'today'));

        // Retornamos el PDF para descarga con un nombre descriptivo
        return $pdf->download('inventario_pinateria.pdf');
    }

    public function registroVentas()
    {
        // Usamos join para traer el nombre del usuario que compró
        $compras = \DB::table('compras')
            ->join('users', 'compras.usuario_id', '=', 'users.id')
            ->select('compras.*', 'users.nombre', 'users.apellido')
            ->get();

        $today = Carbon::now()->format('d/m/Y');

        // Cargamos la nueva vista que crearemos
        $pdf = Pdf::loadView('registroVentas', compact('compras', 'today'));

        return $pdf->download('reporte_ventas_pinateria.pdf');
    }
}
