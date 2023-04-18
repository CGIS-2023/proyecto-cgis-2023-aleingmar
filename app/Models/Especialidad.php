<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    use HasFactory;
   

    protected $fillable = ['nombre'];

    public function sanitarios(){
        return $this->belongsToMany(Sanitario::class)->withPivot('fechaInicio', 'fechaFin');
    }
}
