<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pinata extends Model
{
    protected $fillable = [
        'nombre',
        'tamano',
        'precio',
        'stock',
        'material',
        'categoria_id',
        'imagen_url',
        'activo'
    ];
}
