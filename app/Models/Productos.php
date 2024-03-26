<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Productos extends Model
{
    use SoftDeletes;
    public $timestamps = false;
    protected $table = "productos";
    protected $primaryKey = "id_producto";
    use HasFactory;
    public function proveedor(): BelongsToMany
    {
        return $this->belongsToMany(Proveedores::class)->using(ProveedorProducto::class);
    }
}
