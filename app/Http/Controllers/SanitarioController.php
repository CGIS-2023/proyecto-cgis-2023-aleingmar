<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
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

    //SIRVE PARA CONECTAR CON LAS POLICIES

     public function __construct()
    {
        $this->authorizeResource(Sanitario::class, 'sanitario');
    } 


    
     public function index(Request $request)
    {
        //si soy admin o de dir veo todos los sanitarios
        if(Auth::user()->sanitario->cargo->id == 1 || Auth::user()->sanitario->cargo->id == 2 ){

            //REVISAR SOLO QUERIA QUEDARME CON SANITARIO
            $sanitarios_query = Sanitario::join('users', 'sanitarios.profesion_id', 'users.id')
            ->select('*');  
        }
        //con el DB no funciona pk te dan las cosas como string
        // solo llegan hasta aqui los usuarios de direccion
        
        if(Auth::user()->cargo->id == 3 ){

        $profesion= Auth::user()->sanitario->profesion->id;
        $sanitarios_query = Sanitario::where('sanitarios.profesion_id', $profesion);
        
        }

        

        ////PARA HACER EL FILTRO--> significa que si hay input lo añada a la sentencia
        
        if($request->input('profesion_id')){ //si hay un imput
            $sanitarios_query = $sanitarios_query->where('sanitarios.profesion_id', $request->get('profesion_id')); //se puede tambien con input
            
        }


        //le paso las profesiones para poder filtrar por profesiones y que salga en el desplegable
            //a estos les paso todas
        $profesiones= Profesion::paginate(25); 

        $sanitarios = $sanitarios_query->paginate(25);
        return view('/sanitarios/index', ['sanitarios' => $sanitarios, 'profesiones' => $profesiones, ]);

    }  
    
//////////////////////////PRUEBA//////////////////////////////////////////////////////////////
public function filtrar_prueba(Request $request)
{

    // solo llegan hasta aqui los usuarios de direccion
    //filtro los enfermeros
    $sanitarios_query = Sanitario::join('users', 'sanitarios.profesion_id', 'users.id')
        ->select('*');
        //->where('users.name', 'like', '%'.$buscarpor.'%')

    
    $profesiones= Profesion::paginate(25); 

    if($request->input('buscarpor')){
        $buscarpor= $request->get('buscarpor');
        $sanitarios_query = $sanitarios_query->where('users.name', 'like', '%$buscarpor%'); //se puede tambien con input
        
    }

    $sanitarios = $sanitarios_query->paginate(25);
    return view('/sanitarios/index', ['sanitarios' => $sanitarios, 'profesiones' => $profesiones,]);


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

    ////////////////////////////////////////////PRUEBAS////////////////////////////////////////////////////////////////////////

     
        // FILTROS
    /* $sanitarios_query = Sanitario::where('sanitarios.cargo_id', $cargo);
    if($request->input('profesion_id')){
        $sanitarios_query->where()
    }
    $sanitarios = $sanitarios_query->paginate(25);
    return view('/sanitarios/index', ['sanitarios' => $sanitarios]); */


    //BUSCADOR
    /* public function filtrar_prueba(Request $request)
    {
        $buscarpor= $request->get('buscarpor');

        // solo llegan hasta aqui los usuarios de direccion
        //filtro los enfermeros
        $sanitarios = Sanitario::join('users', 'sanitarios.profesion_id', 'users.id')
            ->select('*')
            ->where('users.name', 'like', '%'.$buscarpor.'%')
            //->where('sanitarios.profesion_id', $profesion->id)
            ->paginate(25);
        
        $profesiones= Profesion::paginate(25); 

        return view('/sanitarios/index', ['sanitarios' => $sanitarios, 'profesiones' => $profesiones, 'buscarpor'=>$buscarpor]);


    }
     */
}
