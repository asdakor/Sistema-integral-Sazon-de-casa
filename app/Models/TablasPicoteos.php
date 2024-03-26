<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TablasPicoteos extends Model
{
    public $timestamps = false;
    protected $primaryKey = "id_tabla";
    use HasFactory;
}
