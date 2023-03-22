<?php

namespace App\Http\Controllers;

//se quitan estas ya que nosotros no vamos a tener en el proyecto esos docs(lo hemos borrado se crean por defecto) si no que lo vamos a 
//confiar en illuminate
//use App\Http\Requests\StoreAccesoRequest;
//use App\Http\Requests\UpdateAccesoRequest; //israel dice que ponga illuminate


use App\Models\Acceso;
use App\Models\Sanitario;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AccesoController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Acceso::class, 'acceso');
    } 
    
    /* public function index()
    {
        // ordenarla de mas reciente
        $accesos = Acceso::orderBy('entrada', 'desc')->paginate(25);
        return view('/accesos/index', ['accesos' => $accesos]);
    } */

   
    public function create()
    {
        //
        //solo puedo crear accesos si soy de la direccion --> se podria hacer que si soy jefe de guardia de enfermeros
        //poder hacerlo solo para los enfermeros

        $sanitarios = Sanitario::all();
        //si soy de direccion

        return view('accesos/create', ['sanitarios' => $sanitarios]);


        //if(Auth::user()->Auth::user()->sanitario->cargo->id == 2){return view('accesos/create', ['personal' => $personal]);}
        //no pongo la condicion ya que solo podran pedir el create los de direccion
        
    }

    
    public function store(Request $request)
    {
        //
        $reglas = [
            'entrada' => 'required|date', //creo que no se puede meter datetime como regla en el validate
            'salida' => 'required|date',
            'sanitario_id' => 'required|exists:sanitarios,id',
        ];


        $this->validate($request, $reglas);
        $accesos = new Acceso($request->all());
        $accesos->save();
        session()->flash('success', 'Acceso creada correctamente. Si nos da tiempo haremos este mensaje internacionalizable y parametrizable');
        return redirect()->route('accesos.index');
    }

    
    public function show(Acceso $acceso)
    {
        //
        return view('accesos/show', ['acceso' => $acceso]);
    }

   
    public function edit(Acceso $acceso)
    {
        //PRESENTA EL FORMULARIO DE EDICION

        // tambien se podria ampliar a si soy jefe de guardia

        $sanitarios = Sanitario::all();

        //if(Auth::user()->Auth::user()->sanitario->cargo->id == 2){return view('accesos/edit', ['accesos' => $acceso, 'personal' => $personal]);}
       
        return view('accesos/edit', ['acceso' => $acceso, 'sanitarios' => $sanitarios]);


    }

   
    public function update(Request $request, Acceso $acceso)
    {
        //

        $reglas = [
            'entrada' => 'required|date',
            'salida' => 'required|date',
            'sanitario_id' => 'required|exists:sanitarios,id',
        ];


        $this->validate($request, $reglas); //comprueba lo que has introducido con las reglas
        $acceso->fill($request->all()); //lo metes en la variable acceso gracias al fillable
        $acceso->save();
        session()->flash('success', 'Acceso modificada correctamente. Si nos da tiempo haremos este mensaje internacionalizable y parametrizable');
        return redirect()->route('accesos.index');


    }

    
    public function destroy(Acceso $acceso)
    {
        //
        if($acceso->delete()) {
            session()->flash('success', 'Acceso borrado correctamente. Si nos da tiempo haremos este mensaje internacionalizable y parametrizable');
        }
        else{
            session()->flash('warning', 'El acceso no pudo borrarse. Es probable que se deba a que tenga asociada información como citas que dependen de él.');
        }
        return redirect()->route('accesos.index');

    }


    ////////////////////////////////////////////PRUEBAS////////////////////////////////////////////////////////////////////////

    public function index()
    {
        // si soy de direccion ---> veo los accesos de todos
        //o si soy admin

        
        $accesos = Acceso::orderBy('entrada', 'desc')->paginate(25);
        

        //auth es coger la info de la persona que ha iniciado secion

        //si soy jefe de guardia enfermero veo todo lo de los enfermeros

        if(Auth::user()->sanitario->cargo->id == 3 & Auth::user()->sanitario->profesion->id == 2){
            //junta accesos y personal sanitario por esos atributos
            //se queda solo con los atributos de la tabla accesos
            // y filtra solo los que sean enfermeros

            $accesos = Acceso::join('sanitarios', 'accesos.sanitario_id', 'sanitarios.id')
            ->select('accesos.*')
            ->where('sanitarios.profesion_id', 2)
            ->orderBy('accesos.entrada', 'desc')
            ->paginate(25);
           
            // ->where('sanitarios.cargo_id', 1)

            // auth::user() --> cogeme la instancia de usuario que ha logueado
            //paginate es el metodo terminal
        }



        //si soy jefe de guardia medicos veo todo lo de los medicos

        if(Auth::user()->sanitario->cargo->id == 3 & Auth::user()->sanitario->profesion->id == 3){

            $accesos = Acceso::join('sanitarios', 'accesos.sanitario_id', 'sanitarios.id')
            ->select('accesos.*')
            ->where('sanitarios.profesion_id', 2)
            ->orderBy('accesos.entrada', 'desc')
            ->paginate(25);
           
        }
       
        // si soy un profesional normal, veo solo mis accesos

        if(Auth::user()->sanitario->cargo->id == 4){
            
            $accesos = Acceso::join('sanitarios', 'accesos.sanitario_id', 'sanitarios.id')
            ->select('accesos.*')
            ->where('sanitarios.id', Auth::user()->sanitario->id)
            ->orderBy('accesos.entrada', 'desc')
            ->paginate(25);
            }
       
            return view('/accesos/index', ['accesos' => $accesos]);
    }








}
