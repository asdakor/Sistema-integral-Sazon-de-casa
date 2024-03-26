<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cajeros extends Model
{
    protected $primaryKey = "rut_trabajador";
    use HasFactory;
    public $timestamps = false;
}
