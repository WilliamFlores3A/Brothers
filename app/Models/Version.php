<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Version extends Model
{
    use HasFactory;
    protected $table = 'versiones';
    
    protected $fillable = ['nombre_version'];

    public function autos()
    {
        return $this->hasMany(Auto::class, 'id_version');
    }
}
