<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
/* use App\Models\Especialidad;
use App\Models\Medico;
use App\Models\Paciente; */
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Rules\Nuhsa;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Cargo;
use App\Models\Profesion;
use App\Models\Sanitario;

class RegisteredUserController extends Controller
{

    // REGISTRO DE LA NUEVA CUENTA DE UN USERS


    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $cargos = Cargo::all();
        $profesiones = Profesion::all();
        return view('auth.register', ['cargos' => $cargos, 'profesiones' => $profesiones]);
        
    }

    /* public function create_medico()
    {
        $especialidads = Especialidad::all();
        return view('auth.register-medico', ['especialidads' => $especialidads]);
    } */

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        


        //////////////
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
            //'telefono' => 'required|integer|digits:9',
            'cargo_id' => 'required|exists:cargos,id',
            'profesion_id' => 'required|exists:profesions,id',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            //'telefono' => $request->telefono,
        ]);

        //aqui mete gracias al fillable los datos en sanitario (crea una instancia)

        $sanitario = new Sanitario($request->all());
        $sanitario->user_id = $user->id;
        $sanitario->save();
        //return redirect(RouteServiceProvider::HOME);

        ///////////

        

        
        $user->fresh();
        Auth::login($user);
        event(new Registered($user));
        //return redirect(RouteServiceProvider::HOME);
        if(Auth::user()->sanitario->cargo->id == 1 & Auth::user()->sanitario->profesion->id == 2){
            return redirect()->route('sanitarios.index');
    
            }
            else{
            return redirect()->route('accesos.index');
            }
    }
}
