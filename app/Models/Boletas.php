<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Boletas extends Model
{
    protected $primaryKey = "id_boleta";
    use SoftDeletes;
    use HasFactory;
    public $incrementing = true;
    public $timestamps = false;
}
