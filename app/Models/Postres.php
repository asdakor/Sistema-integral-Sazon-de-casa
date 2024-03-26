<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postres extends Model
{
    public $timestamps = false;
    protected $primaryKey = "id_postre";
    use HasFactory;
}
