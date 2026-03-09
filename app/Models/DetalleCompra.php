<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleCompra extends Model
{
    public function compra()
    {
        return $this->belongsTo(Compra::class, 'compra_id');
    }

    public function pinata()
    {
        return $this->belongsTo(Pinata::class, 'pinata_id');
    }
}
