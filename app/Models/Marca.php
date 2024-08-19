<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;

    protected $fillable = ['nombre_marca'];

    public function autos()
    {
        return $this->hasMany(Auto::class, 'id_marca');
    }
}

