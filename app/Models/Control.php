<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Control extends Model
{
    public $timestamps = false;
    protected $table = "controles";
    protected $primaryKey = "id_control";
    use HasFactory;
    public $incrementing = true;
    protected $fillable = [
        'id_producto',
        // Otros campos permitidos para asignación masiva, si los hay
    ];
}
