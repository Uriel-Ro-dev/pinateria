<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class compras extends Model
{
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
