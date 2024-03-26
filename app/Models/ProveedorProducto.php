<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Notifications\Notifiable;

class ProveedorProducto extends Pivot
{
    public $timestamps = false;
    use HasFactory;
    use Notifiable;
    protected $table = "productos_proveedores";
    
    
}
