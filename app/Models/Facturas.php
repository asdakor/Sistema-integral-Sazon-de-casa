<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facturas extends Model
{
    protected $primaryKey = "numero_factura";
    use HasFactory;
    public $timestamps = false;
}
