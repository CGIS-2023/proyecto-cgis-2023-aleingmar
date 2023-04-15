<?php

namespace App\Policies;

use App\Models\Incidencia;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class IncidenciaPolicy
{
    use HandlesAuthorization;

   
    public function viewAny(User $user)
    {
        //

        return true;


    }

   
    public function view(User $user, Incidencia $incidencia)
    {
        //
        $res=false;

        //si soy jefe de guardia, direccion y admin
        if(($user->sanitario->cargo->id==1) || ($user->sanitario->cargo->id==2)){

            $res=true;

        }
        // todos pueden acceder a sus accesos
        if ($user->sanitario->id==$incidencia->sanitario->id){
            $res=true;
        }


        return $res;
    }

   
    public function create(User $user)
    {
        return (($user->sanitario->cargo->id == 4) || ($user->sanitario->cargo->id == 3));
    }

    
    public function update(User $user, Incidencia $incidencia)
    {
        //
        return true;
    }

    
    public function delete(User $user, Incidencia $incidencia)
    {
        //
        return (($user->sanitario->cargo->id == 4) || ($user->sanitario->cargo->id == 3));
    }

    
    public function restore(User $user, Incidencia $incidencia)
    {
        //
    }

   
    public function forceDelete(User $user, Incidencia $incidencia)
    {
        //
    }
}
