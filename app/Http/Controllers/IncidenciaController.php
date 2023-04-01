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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $incidencias = Incidencia::orderBy('fechaPresentacion', 'desc')->paginate(25);
        return view('/incidencias/index', ['incidencias' => $incidencias]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $accesos = Acceso::join('sanitarios', 'accesos.sanitario_id', 'sanitarios.id')
            ->select('accesos.*')
            ->where('sanitarios.id', Auth::user()->sanitario->id)
            ->orderBy('accesos.entrada', 'desc');
      

        return view('incidencias/create', ['accesos' => $accesos, ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreIncidenciaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $reglas = [
            'motivoIncidencia' => 'required|string|max:255', //creo que no se puede meter datetime como regla en el validate
            'sanitario_id'=> 'required|exists:sanitarios,id',
            'acceso_id'=> 'required|exists:accesos,id'
        ];

        $this->validate($request, $reglas);

        $motivoIncidencia= $request->motivoIncidencia;

        

        $incidencias = new incidencia([ // 1
            'acceso_id' => 1,
            'sanitario_id'=>1,
            'fechaPresentacion'=> '2021-05-29 04:15:00', 
            'fechaAceptacion'=> '2021-05-30 07:15:00',
            'fechaRechazo'=> Null,
            'motivoIncidencia'=> $motivoIncidencia,
            'motivoRespuesta'=> Null,
        ],
    );


        $incidencias->save();
        session()->flash('success', 'incidencia creada correctamente. Si nos da tiempo haremos este mensaje internacionalizable y parametrizable');
        return redirect()->route('incidencias.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Incidencia  $incidencia
     * @return \Illuminate\Http\Response
     */
    public function show(Incidencia $incidencia)
    {
        
        return view('incidencias/show', ['incidencia' => $incidencia,]); //'cargos' => $cargos, 'profesiones' => $profesiones]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Incidencia  $incidencia
     * @return \Illuminate\Http\Response
     */
    public function edit(Incidencia $incidencia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateIncidenciaRequest  $request
     * @param  \App\Models\Incidencia  $incidencia
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateIncidenciaRequest $request, Incidencia $incidencia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Incidencia  $incidencia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Incidencia $incidencia)
    {
        //
    }
}
