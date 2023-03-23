<?php

namespace App\Policies;

use App\Models\Acceso;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AccesoPolicy
{
    use HandlesAuthorization;

    //SIRVE PARA CONECTAR CON LAS POLICIES

    



    public function viewAny(User $user)
    {
        //
        return true;
    }

    
    public function view(User $user, Acceso $acceso)
    {
        //

        $res=false;

        //si soy jefe de guardia, direccion y admin
        if(($user->sanitario->cargo->id==1) || ($user->sanitario->cargo->id==2) || ($user->sanitario->cargo->id==3) ){

            $res=true;

        }
        // todos pueden acceder a su sanitario
        if ($user->sanitario->id==$acceso->sanitario->id){
            $res=true;
        }


        return $res;

    }

    
    public function create(User $user)
    {
        //
        return (($user->sanitario->cargo->id==1) || ($user->sanitario->cargo->id==2) );
    }

    
    public function update(User $user, Acceso $acceso)
    {
        //
        return (($user->sanitario->cargo->id==1) || ($user->sanitario->cargo->id==2) );
    }

    
    public function delete(User $user, Acceso $acceso)
    {
        //
        return (($user->sanitario->cargo->id==1) || ($user->sanitario->cargo->id==2) );
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Acceso  $acceso
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Acceso $acceso)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Acceso  $acceso
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Acceso $acceso)
    {
        //
    }
}
