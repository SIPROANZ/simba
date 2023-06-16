<?php

namespace App\Http\Controllers;

use App\Empleado;
use App\Unidade;
use App\Gabinete;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use PDF;

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

    public function carnet($id)
    {
      
        $empleado = Empleado::find($id);
        $obj_carbon = new Carbon();
       
        $pdf = PDF::loadView('empleado.carnet', ['empleado'=>$empleado, 'obj_carbon'=>$obj_carbon]);
        $pdf->setPaper(array(0,0,612.00,396.00), 'portrait');
        return $pdf->stream();
 
    }

    public function reportes()
    {
    
        $unidades = Unidade::orderBy('nombre', 'ASC')->pluck('nombre' , 'id'); 
        $gabinetes = Gabinete::orderBy('nombre', 'ASC')->pluck('nombre' , 'id'); 
        $fecha_actual = Carbon::now();
      

        return view('empleado.reportes', compact('fecha_actual','unidades', 'gabinetes'));
            
    }

    public function reporte_pdf(Request $request)
    {
        //Incializando variables POST
        $nombre = $request->nombre;
        $genero = $request->genero;
        $tipo = $request->tipo;
        $unidad_id = $request->unidad;
        $gabinete_id = $request->gabinete;
        $inicio = $request->fecha_inicio;
        $imagen = $request->imagen;
        $fin = $request->fecha_fin;
        $obj_carbon = new Carbon();

        //Obtener el nombre de la unidad
        $rs_unidad = Unidade::find($unidad_id);
        $nombre_unidad ='';
        if($rs_unidad){
            $nombre_unidad =$rs_unidad->nombre; 
        }

        //Obtener el nombre del gabinete
        $rs_gabinete = Gabinete::find($gabinete_id);
        $nombre_gabinete ='';
        if($rs_gabinete){
            $nombre_gabinete =$rs_gabinete->nombre; 
        }

        $empleados = Empleado::unidades($unidad_id)->gabinetes($gabinete_id)->nombre($nombre)->genero($genero)->tipo($tipo)->fechaInicio($inicio)->fechaFin($fin)->get();
       
        $total_ninos = count($empleados->where('genero','MASCULINO'));
        $total_ninas = count($empleados->where('genero','FEMENINO'));

        $total = count($empleados);
        $datos = [
            
            'nombre' => $nombre,
            'genero' => $genero,
            'tipo' => $tipo,
            'nombre_unidad' => $nombre_unidad,
            'nombre_gabinete' => $nombre_gabinete,
            'inicio' => $inicio,
            'fin' => $fin,
            'total' => $total,
            'imagen' => $imagen,
            'total_ninos' => $total_ninos,
            'total_ninas' => $total_ninas,
           
            ]; 

        $pdf = PDF::setPaper('letter', 'landscape')->loadView('empleado.reportepdf', ['datos'=>$datos, 'empleados'=>$empleados, 'obj_carbon'=>$obj_carbon]);
        return $pdf->stream();
        
         
    }
}
