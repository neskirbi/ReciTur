<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Autoridad extends Authenticatable
{
    use HasFactory;
    protected $table = 'autoridades';
    protected $primaryKey = 'id';
    public $incrementing = false;
}