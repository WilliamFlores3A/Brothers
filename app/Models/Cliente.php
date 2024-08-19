<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'apellido', 'cedula', 'telefono', 'correo', 'direccion'];

    public function autos()
    {
        return $this->hasMany(Auto::class, 'cliente_id');
    }

    public function facturas()
    {
        return $this->hasMany(Factura::class, 'cliente_id');
    }
}
