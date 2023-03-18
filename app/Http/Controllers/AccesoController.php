<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAccesoRequest;
use App\Http\Requests\UpdateAccesoRequest; //israel dice que ponga illuminate
//use Illuminate\Http\Request;
use App\Models\Acceso;

class AccesoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // ordenarla de mas reciente
        $accesos = Acceso::orderBy('entrada', 'desc')->paginate(25);
        return view('/accesos/index', ['accesos' => $accesos]);
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
     * @param  \App\Http\Requests\StoreAccesoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAccesoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Acceso  $acceso
     * @return \Illuminate\Http\Response
     */
    public function show(Acceso $acceso)
    {
        //
        return view('accesos/show', ['acceso' => $acceso]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Acceso  $acceso
     * @return \Illuminate\Http\Response
     */
    public function edit(Acceso $acceso)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAccesoRequest  $request
     * @param  \App\Models\Acceso  $acceso
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAccesoRequest $request, Acceso $acceso)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Acceso  $acceso
     * @return \Illuminate\Http\Response
     */
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
