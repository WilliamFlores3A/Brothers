<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;
    protected $table = 'colores';
    protected $fillable = ['nombre_color'];

    public function autos()
    {
        return $this->hasMany(Auto::class, 'id_color');
    }
}
