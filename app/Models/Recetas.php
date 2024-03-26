<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recetas extends Model
{
    use HasFactory;
    public $incrementing = true;
    public $timestamps = false;
    protected $table = "recetas";
    protected $primaryKey = "id_receta";
}
