<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Roles extends Model
{
    public $timestamps = false;
    protected $table = "roles";
    protected $primaryKey = "id_rol";
    use SoftDeletes;
    use HasFactory;
    public function productosfinales(): HasMany
    {
        return $this->hasMany(ProductosFinales::class);
    }
}
