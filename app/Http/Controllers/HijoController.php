<?php

namespace App\Http\Controllers;

use App\Hijo;
use App\Empleado;
use App\Gabinete;
use App\Unidade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use PDF;

/**
 * Class HijoController
 * @package App\Http\Controllers
 */
class HijoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hijos = Hijo::paginate();
        $obj_carbon = new Carbon();

        return view('hijo.index', compact('hijos', 'obj_carbon'))
            ->with('i', (request()->input('page', 1) - 1) * $hijos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hijo = new Hijo();
        return view('hijo.create', compact('hijo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Hijo::$rules);

            //Inicio verificar que la cedula del representante este registrado en el sistema
            $validar_empleado = Empleado::where('cedula', $request->cedularepresentante)->first();
            if($validar_empleado){
                 //Inicio validar que la cedula del niño no se repita
            $validar_hijo = Hijo::where('cedula' , $request->cedula)->first();
            if($validar_hijo){
                return redirect()->route('hijos.index')
                ->with('success', 'Error, el numero de identificacion que quiere utilizar para este niño, ya se encuentra registrado en el sistema. verifique he intentelo nuevamente. Puede ser
                que este niño haya sido registrado por otro representante');
            }
            else{
                  //Agregar el id del usuario
            $id_usuario = $request->user()->id;
            $request->merge(['usuario_id'=>$id_usuario]);

            //Subir al servidor la imagen de perfil del empleado
            $file = $request->file('imagen')->store('public/perfil');
            $url = Storage::url($file);
            //Subir al servidor la imagen de la cedula del empleado
            $fileCedula = $request->file('anexocedula')->store('public/documentos');
            $urlCedula = Storage::url($fileCedula);
            //Subir al servidor la imagen de la partida de nacimiento
            $filePartida = $request->file('anexopartida')->store('public/documentos');
            $urlPartida= Storage::url($filePartida);

            $hijo = Hijo::create($request->all());
            $hijo->imagen = $url;
            $hijo->anexocedula = $urlCedula;
            $hijo->anexopartida = $urlPartida;
            $hijo->save();

            return redirect()->route('hijos.index')
            ->with('success', 'Hijo created successfully.');
            }
            //Fin de validar que la cedula del niño no se repita
            }else{
                return redirect()->route('hijos.index')
                ->with('success', 'Error, el numero de cedula del representante no se encuentra registrado en la base de datos, puede ser que no es empleado, o que aun no ha sido registrado en el sistema.');
           
            }

            //Fin de verificar la cedula del representante

           


          
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hijo = Hijo::find($id);

        $obj_carbon = new Carbon();

        return view('hijo.show', compact('hijo', 'obj_carbon'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hijo = Hijo::find($id);

        return view('hijo.edit', compact('hijo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Hijo $hijo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hijo $hijo)
    {
        request()->validate(Hijo::$rules);

        //inicio de validar que la cedula del representante este registrada en el sistema
        $validar_cedula = Empleado::where('cedula', $request->cedularepresentante)->first();
        if($validar_cedula){
  //validar que la cedula del niño no tome otra que ya este registrada
  $validar_cedula = Hijo::where('cedula', $request->cedula)->first();
  if($validar_cedula && $request->cedula != $hijo->cedula){
    
    return redirect()->route('hijos.index')
      ->with('success', 'Error, el número de cédula que intenta ingresar, ya se encuentra registrado en el sistema.');

  }else{

   //Subir al servidor la imagen de perfil del empleado
   $file = $request->file('imagen')->store('public/perfil');
   $url = Storage::url($file);
   //Subir al servidor la imagen de la cedula del empleado
   $fileCedula = $request->file('anexocedula')->store('public/documentos');
   $urlCedula = Storage::url($fileCedula);
   //Subir al servidor la imagen de la partida de nacimiento
   $filePartida = $request->file('anexopartida')->store('public/documentos');
   $urlPartida= Storage::url($filePartida);

   $hijo->update($request->all());
   
   $hijo->imagen = $url;
   $hijo->anexocedula = $urlCedula;
   $hijo->anexopartida = $urlPartida;
   $hijo->save();

  
  return redirect()->route('hijos.index')
      ->with('success', 'Hijo updated successfully');

  }
        }else{
            return redirect()->route('hijos.index')
            ->with('success', 'Error, el número de cédula del representante no esta registrada en el sistema, esto se debe, a que este empleado aun no hasido registrado
            en el sistema, o esta no es una cedula de un empleado, verifique he intente nuevamente.');
      
        }
        //fin de validar que la cedula del representante este registrada en el sistema

      


    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $hijo = Hijo::find($id)->delete();

        return redirect()->route('hijos.index')
            ->with('success', 'Hijo deleted successfully');
    }

    public function carnet($id)
    {
      
        $hijo = Hijo::find($id);
        $obj_carbon = new Carbon();
       
        $pdf = PDF::loadView('hijo.carnet', ['hijo'=>$hijo, 'obj_carbon'=>$obj_carbon]);
        $pdf->setPaper(array(0,0,612.00,396.00), 'portrait');
        return $pdf->stream();
 
    }

    public function reportes()
    {
    
        $unidades = Unidade::orderBy('nombre', 'ASC')->pluck('nombre' , 'id'); 
        $gabinetes = Gabinete::orderBy('nombre', 'ASC')->pluck('nombre' , 'id'); 
        $fecha_actual = Carbon::now();
      

        return view('hijo.reportes', compact('fecha_actual','unidades', 'gabinetes'));
            
    }

    public function reporte_pdf(Request $request)
    {
        //Incializando variables POST
        $nombre = $request->nombre;
        $cedula = $request->cedula; //cedula del representante
        $nombre_representante = $request->nombre_representante; //nombre_representante del representante
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

        $hijos = Hijo::cedulas($cedula)->nombre_representante($nombre_representante)->gabinetes($gabinete_id)->unidades($unidad_id)->nombre($nombre)->genero($genero)->fechaInicio($inicio)->fechaFin($fin)->get();
        
        $total_ninos = count($hijos->where('genero','MASCULINO'));
        $total_ninas = count($hijos->where('genero','FEMENINO'));


        $total = count($hijos);
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
            'cedula' => $cedula,
            'nombre_representante' => $nombre_representante,
            'total_ninos' => $total_ninos,
            'total_ninas' => $total_ninas,
           
            ]; 

        $pdf = PDF::setPaper('letter', 'landscape')->loadView('hijo.reportepdf', ['datos'=>$datos, 'hijos'=>$hijos, 'obj_carbon'=>$obj_carbon]);
        return $pdf->stream();
        
         
    }
}
