<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class DetallesBoletas extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table = "detalles_boletas";
    protected $primaryKey = "id_detalleboleta";
    public $incrementing = true;
    public $timestamps = false;
}
