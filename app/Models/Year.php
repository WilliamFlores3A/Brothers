<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    use HasFactory;
    protected $fillable = ['year'];

    public function autos()
    {
        return $this->hasMany(Auto::class, 'id_year');
    }
}
