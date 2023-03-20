<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acceso extends Model
{
    use HasFactory;

    protected $fillable = ['entrada', 'salida','sanitario_id'];

    #protected $casts = [];
    protected $casts = [
        'entrada' => 'datetime:Y-m-d H:i',
        'salida' => 'datetime:Y-m-d H:i',
    ];
    
    public function sanitario(){
        return $this->belongsTo(Sanitario::class);
    }
    

    //NO FUNCIONA
    /* public function user(){
        return $this->hasManyThrough(User::class, Sanitario::class);
    } 

    public function profesion(){
        return $this->hasOneThrough(Profesion::class, Sanitario::class);
    
    }*/
    //

    public function getHorasJornadaAttribute(){
        return $this->entrada->diffInHours($this->salida);
    }



}
