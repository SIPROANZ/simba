<?php

namespace App\Http\Controllers;

use App\Asistencia;
use App\Evento;
use App\Empleado;
use App\Hijo;
use Illuminate\Http\Request;

/**
 * Class AsistenciaController
 * @package App\Http\Controllers
 */
class AsistenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $asistencias = Asistencia::paginate();
       

        return view('asistencia.index', compact('asistencias'))
            ->with('i', (request()->input('page', 1) - 1) * $asistencias->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $asistencia = new Asistencia();
        $eventos = Evento::pluck('nombre','id');
        return view('asistencia.create', compact('asistencia', 'eventos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Asistencia::$rules);

        //Agregar el id del usuario
        $id_usuario = $request->user()->id;
        $request->merge(['usuario_id'=>$id_usuario]);
        //Validar que el numero de cedula pertenezca a un empleado de la organizacion o hijo de la organizacion
        $validar_empleado = Empleado::where('cedula',$request->cedula)->first();
        $validar_hijo = Hijo::where('cedula',$request->cedula)->first();
        if($validar_empleado){

            //Antes de hacer el registro validar que el usuario no este ya registrado
        $validar_asistencia = Asistencia::where('cedula',$request->cedula)->where('evento_id', $request->evento_id)->first();
        if($validar_asistencia){
            return redirect()->route('asistencias.index')
            ->with('success', 'Error, el usuario que intenta registrar, ya ha sido registrado anteriormente en este evento.');
        }else{
            $asistencia = Asistencia::create($request->all());

            return redirect()->route('asistencias.index')
                ->with('success', 'Asistencia created successfully.');  
        }

        }elseif($validar_hijo){

            //Antes de hacer el registro validar que el usuario no este ya registrado
        $validar_asistencia = Asistencia::where('cedula',$request->cedula)->where('evento_id', $request->evento_id)->first();
        if($validar_asistencia){
            return redirect()->route('asistencias.index')
            ->with('success', 'Error, el usuario que intenta registrar, ya ha sido registrado anteriormente en este evento.');
        }else{
            $asistencia = Asistencia::create($request->all());

            return redirect()->route('asistencias.index')
                ->with('success', 'Asistencia created successfully.');  
        }

        }else{
            return redirect()->route('asistencias.index')
            ->with('success', 'Error, no se puede hacer el chequeo de la asistencia al evento porque el numero de cedula, no esta registrada en el sistema como empleado, hijo de empleado o jubilado.');
        
        }

        
      

        


    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $asistencia = Asistencia::find($id);

        return view('asistencia.show', compact('asistencia'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $asistencia = Asistencia::find($id);
        $eventos = Evento::pluck('nombre','id');

        return view('asistencia.edit', compact('asistencia', 'eventos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Asistencia $asistencia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Asistencia $asistencia)
    {
        request()->validate(Asistencia::$rules);

        $asistencia->update($request->all());

        return redirect()->route('asistencias.index')
            ->with('success', 'Asistencia updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $asistencia = Asistencia::find($id)->delete();

        return redirect()->route('asistencias.index')
            ->with('success', 'Asistencia deleted successfully');
    }
}
