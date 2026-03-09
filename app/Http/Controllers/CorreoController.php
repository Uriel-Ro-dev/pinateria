<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\EnviarCorreo;

class CorreoController extends Controller
{
    public function enviarPrueba()
	{
    	$mensaje = "¡Gracias por unirte a la familia de Piñatería Piña! Estamos listos para darle un toque especial a tu próxima celebración.";
    	$destinatario = 'destinatario@ejemplo.com';

    	Mail::to($destinatario)->send(new EnviarCorreo($mensaje));

    	return response()->json([
        	'status' => 'success',
        	'message' => 'Correo enviado correctamente.'
    	]);
	}
}
