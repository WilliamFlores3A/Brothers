<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;
    protected $fillable = ['fecha', 'cliente_id', 'observacion'];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function detalleFacturas()
    {
        return $this->hasMany(DetalleFactura::class, 'factura_id');
    }
}
