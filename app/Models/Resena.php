<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resena extends Model
{
    public function pinata()
    {
        return $this->belongsTo(Pinata::class, 'pinata_id');
    }

    public function cliente()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
