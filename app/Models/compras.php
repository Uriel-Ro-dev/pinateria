<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class compras extends Model
{

    protected $fillable =
    [
            'folio_compra',
            'fecha_registro',
            'total_compra',
            'metodo_pago',
            'usuario_id'
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function detalles()
    {
        return $this->hasMany(DetalleCompra::class, 'compra_id');
    }
}
