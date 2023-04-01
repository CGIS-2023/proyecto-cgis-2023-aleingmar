<?php

namespace App\Http\Controllers;

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
        //
        $incidencias = Incidencia::orderBy('fechaPresentacion', 'desc')->paginate(25);
        return view('/incidencias/index', ['incidencias' => $incidencias]);

    }

    public function create()
    {
        // solo van a poder crear incidencias --> jefes y sanitarios (a nv personal)

        
        $accesos = Acceso::join('sanitarios', 'accesos.sanitario_id', 'sanitarios.id')
        ->select('accesos.*')
        ->where('sanitarios.id', Auth::user()->sanitario->id)
        ->orderBy('accesos.entrada', 'desc');
      

        return view('incidencias/create', ['accesos' => $accesos, ]);
    }

    
    public function store(Request $request)
    {
        //
        $reglas = [
            'motivoIncidencia' => 'required|string|max:255', //creo que no se puede meter datetime como regla en el validate
            //'sanitario_id'=> 'required|exists:sanitarios,id',
            'acceso_id'=> 'required|exists:accesos,id'
        ];

        $this->validate($request, $reglas);

        $user = Incidencia::create([
            'sanitario_id' => Auth::user()->sanitario->id,
            'motivoIncidencia' => $request->motivoIncidencia,
            'acceso_id' => $request->acceso_id,
            
        ]);
    


        $incidencias->save();
        session()->flash('success', 'incidencia creada correctamente. Si nos da tiempo haremos este mensaje internacionalizable y parametrizable');
        return redirect()->route('incidencias.index');
    }

   
    public function show(Incidencia $incidencia)
    {
        
        return view('incidencias/show', ['incidencia' => $incidencia,]); //'cargos' => $cargos, 'profesiones' => $profesiones]);
    }

    

    public function edit(Incidencia $incidencia)
    {
        //
        $accesos = Acceso::join('sanitarios', 'accesos.sanitario_id', 'sanitarios.id')
        ->select('accesos.*')
        ->where('sanitarios.id', Auth::user()->sanitario->id)
        ->orderBy('accesos.entrada', 'desc');


        return view('sanitarios/edit', ['accesos' => $accesos, ]);
    }


    public function update(Request $request, Incidencia $incidencia)
    {
       
    }

    




    public function destroy(Incidencia $incidencia)
    {
        //
    }
}
