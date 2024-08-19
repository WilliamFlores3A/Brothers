<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auto extends Model
{
    use HasFactory;

    protected $fillable = ['id_modelo', 'id_version', 'id_marca', 'id_color', 'id_year', 'placa', 'cliente_id'];

    public function modelo()
    {
        return $this->belongsTo(Modelo::class, 'id_modelo');
    }

    public function version()
    {
        return $this->belongsTo(Version::class, 'id_version');
    }

    public function marca()
    {
        return $this->belongsTo(Marca::class, 'id_marca');
    }

    public function color()
    {
        return $this->belongsTo(Color::class, 'id_color');
    }

    public function year()
    {
        return $this->belongsTo(Year::class, 'id_year');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function consultas()
    {
        return $this->hasMany(Consulta::class, 'Auto_ID');
    }
}
