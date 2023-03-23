<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAccesoCentroRequest;
use App\Http\Requests\UpdateAccesoCentroRequest; //israel dice que ponga illuminate
//use Illuminate\Http\Request;
use App\Models\AccesoCentro;

class AccesoCentroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // ordenarla de mas reciente
        $accesos = AccesoCentro::orderBy('entrada', 'desc')->paginate(25);
        return view('/acceso_centros/index', ['accesos' => $accesos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAccesoCentroRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAccesoCentroRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AccesoCentro  $accesoCentro
     * @return \Illuminate\Http\Response
     */
    public function show(AccesoCentro $accesoCentro)
    {
        //
        return view('acceso_centros/show', ['acceso' => $accesoCentro]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AccesoCentro  $accesoCentro
     * @return \Illuminate\Http\Response
     */
    public function edit(AccesoCentro $accesoCentro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAccesoCentroRequest  $request
     * @param  \App\Models\AccesoCentro  $accesoCentro
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAccesoCentroRequest $request, AccesoCentro $accesoCentro)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AccesoCentro  $accesoCentro
     * @return \Illuminate\Http\Response
     */
    public function destroy(AccesoCentro $accesoCentro)
    {
        //
        if($accesoCentro->delete()) {
            session()->flash('success', 'Acceso borrado correctamente. Si nos da tiempo haremos este mensaje internacionalizable y parametrizable');
        }
        else{
            session()->flash('warning', 'El acceso no pudo borrarse. Es probable que se deba a que tenga asociada información como citas que dependen de él.');
        }
        return redirect()->route('accesos.index');

    }
}
