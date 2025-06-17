<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recoleccion extends Model
{
    use HasFactory;  
    protected $table = 'recolecciones';
    protected $primaryKey = 'id';
    public $incrementing = false;
}
