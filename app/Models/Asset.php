<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    protected $fillable = ['title', 'image', 'video_path', 'pinata_id'];

    public function pinata()
    {
        return $this->belongsTo(pinata::class, 'pinata_id');
    }
}
