<?php

namespace App\Http\Controllers;

use App\Empleado;
use App\Unidade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

/**
 * Class EmpleadoController
 * @package App\Http\Controllers
 */
class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empleados = Empleado::paginate();
        $obj_carbon = new Carbon();

        return view('empleado.index', compact('empleados', 'obj_carbon'))
            ->with('i', (request()->input('page', 1) - 1) * $empleados->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $empleado = new Empleado();
        $unidades = Unidade::pluck('nombre', 'id');
        return view('empleado.create', compact('empleado', 'unidades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Empleado::$rules);

        //validar que la cedula del usuario no este repetida en el sistema
        $validar_cedula = Empleado::where('cedula', $request->cedula)->first();
        if($validar_cedula){

           return redirect()->route('empleados.index')
            ->with('success', 'Error, el número de cédula que intenta ingresar, ya se encuentra registrado en el sistema.'); 

        }else{
 //Agregar el id del usuario
 $id_usuario = $request->user()->id;
 $request->merge(['usuario_id'=>$id_usuario]);
 //Subir al servidor la imagen de perfil del empleado
 $file = $request->file('imagen')->store('public/perfil');
 $url = Storage::url($file);
 //Subir al servidor la imagen de la cedula del empleado
 $fileCedula = $request->file('imagencedula')->store('public/documentos');
 $urlCedula = Storage::url($fileCedula);
 

 $empleado = Empleado::create($request->all());
 //Actualizar las url en la base dadtos para el empleado recien creado.
 $empleado->imagen = $url;
 $empleado->imagencedula = $urlCedula;
 $empleado->save();


 return redirect()->route('empleados.index')
     ->with('success', 'Empleado created successfully.');
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
        $empleado = Empleado::find($id);

        $obj_carbon = new Carbon();

        return view('empleado.show', compact('empleado', 'obj_carbon'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $empleado = Empleado::find($id);
        $unidades = Unidade::pluck('nombre', 'id');

        return view('empleado.edit', compact('empleado', 'unidades'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Empleado $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Empleado $empleado)
    {
        request()->validate(Empleado::$rules);

        


          //validar que la cedula del usuario no este repetida en el sistema
          $validar_cedula = Empleado::where('cedula', $request->cedula)->first();
          if($validar_cedula && $request->cedula != $empleado->cedula){
            return redirect()->route('empleados.index')
            ->with('success', 'Error, el número de cédula que intenta ingresar, ya se encuentra registrado en el sistema.');

          }else{
   
   //Subir al servidor la imagen de perfil del empleado
   $file = $request->file('imagen')->store('public/perfil');
   $url = Storage::url($file);
   //Subir al servidor la imagen de la cedula del empleado
   $fileCedula = $request->file('imagencedula')->store('public/documentos');
   $urlCedula = Storage::url($fileCedula);
    
   //Actualizar las url en la base dadtos para el empleado recien creado.
  
   $empleado->update($request->all());
   $empleado->imagen = $url;
   $empleado->imagencedula = $urlCedula;
   $empleado->save();

   return redirect()->route('empleados.index')
       ->with('success', 'Empleado updated successfully');

          }



    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $empleado = Empleado::find($id)->delete();

        return redirect()->route('empleados.index')
            ->with('success', 'Empleado deleted successfully');
    }
}
