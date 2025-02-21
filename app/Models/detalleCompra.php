<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detalleCompra extends Model
{
    use HasFactory;

    public function compra()
    {
        return $this->belongsTo(compra::class);
    }

    public function proveedor()
    {
        return $this->belongsTo(proveedor::class);
    }

    public function producto(){
        return $this->belongsTo(producto::class);
    }
}
