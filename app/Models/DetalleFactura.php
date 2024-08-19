<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleFactura extends Model
{
    use HasFactory;

    protected $table = 'detalle_factura';

    protected $fillable = ['factura_id', 'consulta_id', 'descripcion', 'costeTotal'];

    public function factura()
    {
        return $this->belongsTo(Factura::class, 'factura_id');
    }

    public function consulta()
    {
        return $this->belongsTo(Consulta::class, 'consulta_id');
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($detalleFactura) {
            $consulta = Consulta::find($detalleFactura->consulta_id);
            if ($consulta && $consulta->servicio) {
                $detalleFactura->costeTotal = $consulta->servicio->costoServicio;
            } else {
                $detalleFactura->costeTotal = 0; // O establece un valor predeterminado
            }
        });
    }
}
