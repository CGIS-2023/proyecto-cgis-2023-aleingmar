<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Incidencia extends Model
{
    use HasFactory;

    //'fechaAceptacion', 'fechaRechazo',y fechaPresentacion NO SE PONEN EN EL FILLABLE pk no lo tienen que ppner en el formulario
    //NO LO USO EN EL CONTROLADOR
    protected $fillable = ['acceso_id', 'sanitario_id', 
    'motivoIncidencia', 'motivoRespuesta'];
    
    //aunque no esten en el fillable hay que ponerlos en el cast ya que por ej en los seeder se mete un string con ese formato--> hay que pasarlo a date
    protected $casts = [
        'fechaAceptacion' => 'datetime:Y-m-d H:i',
        'fechaRechazo' => 'datetime:Y-m-d H:i',
        'fechaPresentacion'=> 'datetime:Y-m-d H:i',
    ]; 

    #/////////////////// RELACIOMES ---> con esto creamos las relaciones entre los modelos y obtenemos
    // las entidades relacionadas
    public function acceso(){
        return $this->belongsTo(Acceso::class);
    }



    public function sanitario(){
        return $this->belongsto(Sanitario::class);
    }
    

    #/////////////////// QUERYS ---> cunsultas usando el ORM de eloquence



///ATRIBUTOS DERIVADOS

    public function getEstadoAttribute(){
    // me gusstaria hacerlo en el ultimo mes // Carbon::now()->month

        if($this->fechaAceptacion != Null){
            $res= 'Aceptada';
        }
        elseif($this->fechaRechazo != Null){
            $res='Rechazada';
        }else{
            $res='En trámite';
        }
        return $res;

    }

    public function getFechaRespuestaAttribute(){
        // me gusstaria hacerlo en el ultimo mes // Carbon::now()->month
    
            if($this->fechaAceptacion != Null){
                $res= $this->fechaAceptacion;
            }
            else{
                $res=$this->fechaRechazo;
            }
            return $res;
    
        }



}
