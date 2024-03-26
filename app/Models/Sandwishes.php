<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sandwishes extends Model
{
    public $timestamps = false;
    protected $primaryKey = "id_sandwish";
    use HasFactory;
}
