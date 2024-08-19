<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    use HasFactory;
    protected $fillable = ['FechaDelIngreso','HoraEntrada', 'FechaSalida', 'HoraSalida', 'DetallesTecnicos', 'Observacion', 'Auto_ID', 'Mecanico_ID', 'Material_ID', 'Servicio_ID'];

    public function auto()
    {
        return $this->belongsTo(Auto::class, 'Auto_ID');
    }

    public function mecanico()
    {
        return $this->belongsTo(Mecanico::class, 'Mecanico_ID');
    }

    public function material()
    {
        return $this->belongsTo(Material::class, 'Material_ID');
    }

    public function servicio()
    {
        return $this->belongsTo(Servicio::class, 'Servicio_ID');
    }

    public function detalleFacturas()
    {
        return $this->hasMany(DetalleFactura::class, 'consulta_id');
    }
}