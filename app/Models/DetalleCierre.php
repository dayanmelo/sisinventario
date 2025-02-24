<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleCierre extends Model
{
    use HasFactory;

    public function cierre()
    {
        return $this->belongsTo(Cierre::class);
    }

    public function producto(){
        return $this->belongsTo(Producto::class);
    }
}
