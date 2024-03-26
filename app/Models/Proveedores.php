<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proveedores extends Model
{
    public $timestamps = false;
    protected $table = "proveedores";
    protected $primaryKey = "rut_proveedor";
    use SoftDeletes;
    use HasFactory;
    public function producto(): BelongsToMany
    {
        return $this->belongsToMany(Productos::class)->using(ProveedorProducto::class);
    }
}
