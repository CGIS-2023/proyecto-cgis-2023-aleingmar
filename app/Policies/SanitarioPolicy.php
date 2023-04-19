<?php

namespace App\Policies;

use App\Models\Sanitario;
use App\Models\Cargo;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SanitarioPolicy
{
    use HandlesAuthorization;

    

     //referencia con el index del controlador de sanitario
    public function viewAny(User $user)
    {
        #return (($user->sanitario->cargo->id==1) || ($user->sanitario->cargo->id==2) || ($user->sanitario->cargo->id==3));
        return true;
    }

    //referencia al show
    public function view(User $user, Sanitario $sanitario)
    {
        $res=false;

        //si soy jefe de guardia, direccion y admin
        if(($user->sanitario->cargo->id==1) || ($user->sanitario->cargo->id==2) || ($user->sanitario->cargo->id==3) ){

            $res=true;

        }
        // todos pueden acceder a su sanitario
        if ($user->sanitario->id==$sanitario->id){
            $res=true;
        }


        return $res;
    }

    // SOLO PUEDO CREAR MODIFICAR Y BORRAR SI SOY ADMIN O DE DIRECCION
    public function create(User $user)
    {
        //
        return (($user->sanitario->cargo->id==1) || ($user->sanitario->cargo->id==2) );
    }

    
    public function update(User $user, Sanitario $sanitario)
    {
        //
        return (($user->sanitario->cargo->id==1) || ($user->sanitario->cargo->id==2) );
    }

    
    public function delete(User $user, Sanitario $sanitario)
    {
        //
        return (($user->sanitario->cargo->id==1) || ($user->sanitario->cargo->id==2) );
    }

    //////////////////////////////////////////
    
    public function restore(User $user, Sanitario $sanitario)
    {
        //
    }

    
    public function forceDelete(User $user, Sanitario $sanitario)
    {
        //
    }

    /////////////////////////////////////////////////
    //ASOCIAR POLICIES A METODOS FUERA DEL CRUUUD
    
    public function attach_especialidad(User $user, Sanitario $sanitario)
    {
        return true; 
    }   

    public function dettach_especialidad(User $user, Sanitario $sanitario)
    {
        return true; 
    }   

    



}
