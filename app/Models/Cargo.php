<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    use HasFactory;


    protected $fillable = ['nombre'];

    public function sanitarios(){
        return $this->hasMany(Sanitario::class);
    }

    
    //para jugar un poco
    //accedo a los accesos de un tipo de cargo:

    /* public function accesos(){
        return $this->hasManyThrough(Acceso::class, Sanitario::class);
    } */
}
