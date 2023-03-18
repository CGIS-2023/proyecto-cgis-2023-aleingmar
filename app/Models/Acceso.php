<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acceso extends Model
{
    use HasFactory;

    protected $fillable = ['entrada', 'salida', 'personal_sanitario_id'];

    #protected $casts = [];
    protected $casts = [
        'entrada' => 'datetime:Y-m-d H:i',
        'salida' => 'datetime:Y-m-d H:i',
    ];
    /*
    public function personal_sanitario(){
        return $this->belongsTo(PersonalSanitario::class);
    }
    */

    //

    public function getHorasJornadaAttribute(){
        return $this->entrada->diffInHours($this->salida);
    }



}
