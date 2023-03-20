<?php

namespace App\Models;


use Carbon\Carbon;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sanitario extends Model
{
    use HasFactory;

    //protected $fillable = ['profesion_id', 'cargo_id'];
    
    #protected $casts = [];

    #/////////////////// RELACIOMES ---> con esto creamos las relaciones entre los modelos y obtenemos
    // las entidades relacionadas
    public function user(){
        return $this->belongsTo(User::class);
    }

     #public function especialidad(){return $this->belongsTo(Especialidad::class);}

    public function accesos(){
        return $this->hasMany(Acceso::class);
    }
    /*
    public function cargo(){
        return $this->belongsTo(Cargo::class);
    }

    public function profesion(){
        return $this->belongsTo(Profesion::class);
    } */



    #/////////////////// QUERYS ---> cunsultas usando el ORM de eloquence

    public function getTiempoTrabajadoAttribute(){
    // me gusstaria hacerlo en el ultimo mes // Carbon::now()->month

        $accesos= $this-> accesos()->get();
        
        $res=0;
        foreach ($accesos as $acceso) {
            $res= $res + ($acceso->getHorasJornadaAttribute());
            
        }
        return $res;

    }



    
}
