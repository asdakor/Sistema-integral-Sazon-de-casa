<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categorias extends Model
{
    public $timestamps = false;
    protected $table = "categorias";
    protected $primaryKey = "id_categoria";
    use HasFactory;
    public $incrementing = true;
}
