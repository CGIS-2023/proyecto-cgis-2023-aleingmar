<?php

namespace App\Http\Controllers;

//se quitan estas ya que nosotros no vamos a tener en el proyecto esos docs(lo hemos borrado se crean por defecto) si no que lo vamos a 
//confiar en illuminate
//use App\Http\Requests\StoreAccesoRequest;
//use App\Http\Requests\UpdateAccesoRequest; //israel dice que ponga illuminate


use App\Models\Acceso;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AccesoController extends Controller
{
    
    public function index()
    {
        // ordenarla de mas reciente
        $accesos = Acceso::orderBy('entrada', 'desc')->paginate(25);
        return view('/accesos/index', ['accesos' => $accesos]);
    }

   
    public function create()
    {
        //
        //solo puedo crear accesos si soy de la direccion --> se podria hacer que si soy jefe de guardia de enfermeros
        //poder hacerlo solo para los enfermeros

        //$personal = PersonalSanitario::all();
        //si soy de direccion

        return view('accesos/create',); //['personal' => $personal]);


        //if(Auth::user()->Auth::user()->cargo()->id == 2){return view('accesos/create', ['personal' => $personal]);}
        //no pongo la condicion ya que solo podran pedir el create los de direccion
        
    }

    
    public function store(Request $request)
    {
        //
        $reglas = [
            'entrada' => 'required|date', //creo que no se puede meter datetime como regla en el validate
            'salida' => 'required|date',
            //'personal_sanitario_id' => 'required|exists:personal_sanitarios,id',
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

        //$personal = PersonalSanitario::all();

        //if(Auth::user()->Auth::user()->cargo()->id == 2){return view('accesos/edit', ['accesos' => $acceso, 'personal' => $personal]);}
       
        return view('accesos/edit', ['acceso' => $acceso, ]);//'personal' => $personal]);


    }

   
    public function update(Request $request, Acceso $acceso)
    {
        //

        $reglas = [
            'entrada' => 'required|date',
            'salida' => 'required|date',
            //'personal_sanitario_id' => 'required|exists:personal_sanitarios,id',
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
}
