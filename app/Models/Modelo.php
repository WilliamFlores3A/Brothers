<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    use HasFactory;

    protected $fillable = ['nombre_modelo'];

    public function autos()
    {
        return $this->hasMany(Auto::class, 'id_modelo');
    }
    
}









    
