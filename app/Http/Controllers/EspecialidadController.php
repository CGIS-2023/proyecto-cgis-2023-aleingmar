<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use App\Models\Sanitario;
use App\Models\User;
use App\Models\Cargo;
use App\Models\Profesion;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Especialidad;


//NO TIENE FRONTEND (vistas)

class EspecialidadController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Especialidad::class, 'especialidad');
    }


    public function index()
    {
        //
        $especialidades = Especialidad::paginate(25);
        return view('/especialidades/index', ['especialidades' => $especialidades]);
    }

    


    public function create()
    {
        return view('especialidades/create');
    }

    



    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'nombre' => 'required|string|max:255',
        ], [
            'nombre.required' => 'La especialidad es obligatoria',
        ]);
        $especialidad = new Especialidad($request->all());
        $especialidad->save();
        session()->flash('success', 'Especialidad creada correctamente. Si nos da tiempo haremos este mensaje internacionalizable y parametrizable');
        return redirect()->route('especialidads.index');
    }

    


    public function show(Especialidad $especialidad)
    {
        //
    }

    


    public function edit(Especialidad $especialidad)
    {
        // no si quiero que se pueda editar una especialidad (cambiar el nombre??)
        return view('especialidades/edit', ['especialidad' => $especialidad]);
    }

    


    public function update(Request $request, Especialidad $especialidad)
    {
        //
        $this->validate($request, [
            'nombre' => 'required|string|max:255',
           
        ]);
        $especialidad->fill($request->all());
        $especialidad->save();
        session()->flash('success', 'Especialidad modificada correctamente. Si nos da tiempo haremos este mensaje internacionalizable y parametrizable');
        return redirect()->route('especialidads.index');
    }

    


    public function destroy(Especialidad $especialidad)
    {
        //
        if($especialidad->delete()) {
            session()->flash('success', 'Especialidad borrada correctamente. Si nos da tiempo haremos este mensaje internacionalizable y parametrizable');
        }
        else{
            session()->flash('warning', 'No pudo borrarse la especialidad.');
        }
        return redirect()->route('especialidads.index');
    }
}
