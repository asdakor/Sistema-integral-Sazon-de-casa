<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Detalles extends Model
{
    use SoftDeletes;
    use HasFactory;
    public $timestamps = false;
    public $incrementing = true;
    protected $primaryKey = "id_detalle";
}
