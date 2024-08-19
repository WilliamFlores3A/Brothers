<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $table = 'materiales';

    protected $fillable = ['nombre', 'descripcion', 'costoMaterial', 'stock'];

    public function consultas()
    {
        return $this->hasMany(Consulta::class, 'Material_ID');
    }

}
