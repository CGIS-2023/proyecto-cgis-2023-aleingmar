<?php

namespace App\Http\Controllers;
use Carbon\Carbon;

/* use App\Http\Requests\StoreIncidenciaRequest;
use App\Http\Requests\UpdateIncidenciaRequest; */
use App\Models\Incidencia;

use App\Models\Sanitario;
use App\Models\Acceso;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class IncidenciaController extends Controller
{
    
    public function index()
    {
        // si eres admin o de direc
        $incidencias = Incidencia::orderBy('fechaPresentacion', 'desc')->paginate(25);

        //si eres jefe de guardia o sanitario normal solo ves lo tuyo
        if(Auth::user()->sanitario->cargo->id == 4 || Auth::user()->sanitario->cargo->id == 3){
            
            $incidencias = Incidencia::join('sanitarios', 'incidencias.sanitario_id', 'sanitarios.id')
            ->select('incidencias.*')
            ->where('sanitarios.id', Auth::user()->sanitario->id)
            ->orderBy('incidencias.fechaPresentacion', 'desc')
            ->paginate(25);
            }


        return view('/incidencias/index', ['incidencias' => $incidencias]);

    }

    public function create()
    {
        // solo van a poder crear incidencias --> jefes y sanitarios (a nv personal)

        
        $accesos = Acceso::join('sanitarios', 'accesos.sanitario_id', 'sanitarios.id')
        ->select('accesos.*')
        ->where('sanitarios.id', Auth::user()->sanitario->id)
        ->orderBy('accesos.entrada', 'desc')->paginate(25);
      

        return view('incidencias/create', ['accesos' => $accesos, ]);
    }

    
    public function store(Request $request)
    {
        //
        $reglas = [
            'motivoIncidencia' => 'required|string|max:255', //creo que no se puede meter datetime como regla en el validate
            //'sanitario_id'=> 'required|exists:sanitarios,id',
            'acceso_id'=> 'nullable|exists:accesos,id'
        ];

        $this->validate($request, $reglas);

        $incidencia= new Incidencia;

        //el resto de atributos se me ponen a nulos si no los ponemos
        $incidencia->sanitario_id= Auth::user()->sanitario->id;
        $incidencia->fechaPresentacion= Carbon::now();
        $incidencia->motivoIncidencia= $request->motivoIncidencia;
        $incidencia->acceso_id= $request->acceso_id;

        
    


        $incidencia->save();
        session()->flash('success', 'incidencia creada correctamente. Si nos da tiempo haremos este mensaje internacionalizable y parametrizable');
        return redirect()->route('incidencias.index');
    }

   
    public function show(Incidencia $incidencia)
    {
        
        return view('incidencias/show', ['incidencia' => $incidencia,]); 
    }

    



    public function edit(Incidencia $incidencia)
    {
        // este es el edit para los profesionales normales y los jefes de guardia


        $accesos = Acceso::join('sanitarios', 'accesos.sanitario_id', 'sanitarios.id')
        ->select('accesos.*')
        ->where('sanitarios.id', Auth::user()->sanitario->id)
        ->orderBy('accesos.entrada', 'desc')->paginate(25);


        return view('incidencias/edit', ['accesos' => $accesos, 'incidencia'=> $incidencia]);
    }





    public function update(Request $request, Incidencia $incidencia)
    {
       
        $this->validate($request, [
            'motivoIncidencia' => 'required|string|max:255', //creo que no se puede meter datetime como regla en el validate
            //'sanitario_id'=> 'required|exists:sanitarios,id',
            'acceso_id'=> 'nullable|exists:accesos,id'
        ]);
       
        //retoco los datos de la incidencia
        $incidencia->sanitario_id= Auth::user()->sanitario->id;
        $incidencia->fechaPresentacion= Carbon::now();
        $incidencia->motivoIncidencia= $request->motivoIncidencia;
        $incidencia->acceso_id= $request->acceso_id;


        session()->flash('success', 'Personal Sanitario creado correctamente. Si nos da tiempo haremos este mensaje internacionalizable y parametrizable');
        return redirect()->route('incidencias.index');








    }

    




    public function destroy(Incidencia $incidencia)
    {
        //no pueden los de direccion
 

        if($incidencia->delete()) {
            session()->flash('success', 'Incidencia borrado correctamente. Si nos da tiempo haremos este mensaje internacionalizable y parametrizable');
        }
        else{
            session()->flash('warning', 'La incidencia no pudo borrarse. Es probable que se deba a que tenga asociada información como citas que dependen de él.');
        }
        return redirect()->route('incidencias.index');
    }
}
