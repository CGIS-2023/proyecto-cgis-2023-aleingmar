<?php

namespace App\Http\Controllers;


use App\Models\Sanitario;
use App\Models\User;
use App\Models\Cargo;
use App\Models\Profesion;

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;
//use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class SanitarioController extends Controller
{
    
    public function index()
    {
        // solo llegan hasta aqui los usuarios de direccion

        $sanitarios = Sanitario::paginate(25);
        return view('/sanitarios/index', ['sanitarios' => $sanitarios]);


    }
    
//////////////////////////PRUEBA//////////////////////////////////////////////////////////////
    public function filtrar_prueba()
    {
        // solo llegan hasta aqui los usuarios de direccion
        //filtro los enfermeros
        $sanitarios = Sanitario::join('profesions', 'sanitarios.profesion_id', 'profesions.id')
            ->select('*')
            ->where('sanitarios.profesion_id', 2)
            ->paginate(25);

        return view('/sanitarios/index', ['sanitarios' => $sanitarios]);


    }
   
////////////////////////////////////////////////////////////////////////////////////////


    public function create()
    {
        //
        // solo direccion
        $cargos = Cargo::all();
        $profesiones = Profesion::all();
        return view('sanitarios/create', ['cargos' => $cargos, 'profesiones' => $profesiones]);
    }

    




    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
            //'telefono' => 'required|integer|digits:9',
            //'cargo_id' => 'required|exists:cargos,id',
            //'profesion_id' => 'required|exists:profesions,id',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            //'telefono' => $request->telefono,
        ]);

        //DUDA

        $sanitario = new Sanitario($request->all());
        $sanitario->user_id = $user->id;
        $sanitario->save();
        session()->flash('success', 'Personal Sanitario creado correctamente. Si nos da tiempo haremos este mensaje internacionalizable y parametrizable');
        return redirect()->route('sanitarios.index');

    }

    


    public function show(Sanitario $sanitario)
    {
        //DUDA -> pk en el show se le pasa el listado de cargos y profesiones (profesional_sanitario)

        //$cargos = Cargo::all();
        //$profesiones = Profesion::all();
        return view('sanitarios/show', ['sanitario' => $sanitario,]); //'cargos' => $cargos, 'profesiones' => $profesiones]);
    }

    





    public function edit(Sanitario $sanitario)
    {
        //
        $cargos = Cargo::all();
        $profesiones = Profesion::all();
        return view('sanitarios/edit', ['sanitario' => $sanitario, 'cargos' => $cargos, 'profesiones' => $profesiones]);
    }

    





    public function update(Request $request, Sanitario $sanitario)
    {
        //
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
            //'telefono' => 'required|integer|digits:9',
            //'cargo_id' => 'required|exists:cargos,id',
            //'profesion_id' => 'required|exists:profesions,id',
        ]);

       
        //DUDA 
        $user = $sanitario->user;
        $user->fill($request->all());
        $user->save();
        $sanitario->fill($request->all());
        $sanitario->save();
        session()->flash('success', 'Personal Sanitario creado correctamente. Si nos da tiempo haremos este mensaje internacionalizable y parametrizable');
        return redirect()->route('sanitarios.index');
    }

    




    public function destroy(Sanitario $sanitario)
    {
        //
        if($sanitario->delete()) {
            session()->flash('success', 'Personal Sanitario borrado correctamente. Si nos da tiempo haremos este mensaje internacionalizable y parametrizable');
        }
        else{
            session()->flash('warning', 'El personal sanitario no pudo borrarse. Es probable que se deba a que tenga asociada información como citas que dependen de él.');
        }
        return redirect()->route('sanitarios.index');
    }
}
