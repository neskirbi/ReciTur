<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Recolector extends Authenticatable
{
    use HasFactory;
    protected $table = 'recolectores';
    protected $primaryKey = 'id';
    public $incrementing = false;
}
