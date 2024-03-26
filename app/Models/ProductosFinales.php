<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductosFinales extends Model
{
    public $timestamps = false;
    protected $table = "productos_finales";
    protected $primaryKey = "id_productofinal";
    use HasFactory;
    use SoftDeletes;
    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categorias::class);
    }
}
