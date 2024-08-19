<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mecanico extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'apellido', 'cedula', 'telefono', 'correo', 'salario', 'direccion'];

    public function consultas()
    {
        return $this->hasMany(Consulta::class, 'Mecanico_ID');
    }
}
