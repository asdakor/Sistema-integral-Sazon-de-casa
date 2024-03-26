<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mermas extends Model
{
    use HasFactory;
    public $incrementing = true;
    public $timestamps = false;
    protected $table = "mermas";
    protected $primaryKey = "id_mermas";
}
