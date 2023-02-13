<?php

namespace App\Http\Controllers;

use App\Analisi;
use App\Unidadadministrativa;
use App\Requisicione;
use App\Beneficiario;
use App\Criterio;
use App\Detallesanalisi;
use App\Detallesrequisicione;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use PDF;

/**
 * Class AnalisiController
 * @package App\Http\Controllers
 */
class AnalisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // $analisis = Analisi::where('estatus', 'EP')->paginate();


        $analisis = Analisi::query()
        ->when(request('search'), function($query){
            return $query->where ('id', 'like', '%'.request('search').'%')
                              ->where('estatus', 'like', 'EP')
                         ->orWhereHas('unidadadministrativa', function($q){
                          $q->where('unidadejecutora', 'like', '%'.request('search').'%');
                          })
                          ->where('estatus', 'like', 'EP')
                           ->orWhereHas('requisicione', function($qa){
                             $qa->where('correlativo', 'like', '%'.request('search').'%');
                         })
                         ->where('estatus', 'like', 'EP');
         },
         function ($query) {
             $query->where('estatus', 'like', 'EP')
             ->orderBy('id', 'DESC');
         })
        ->paginate(25)
        ->withQueryString();



        return view('analisi.index', compact('analisis'))
            ->with('i', (request()->input('page', 1) - 1) * $analisis->perPage());
    }

    /**
     * Display requisiciones procesadas.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexprocesadas()
    {
       // $analisis = Analisi::where('estatus', 'PR')->paginate();

        $analisis = Analisi::query()
        ->when(request('search'), function($query){
            return $query->where ('id', 'like', '%'.request('search').'%')
                              ->where('estatus', 'like', 'PR')
                         ->orWhereHas('unidadadministrativa', function($q){
                          $q->where('unidadejecutora', 'like', '%'.request('search').'%');
                          })
                          ->where('estatus', 'like', 'PR')
                           ->orWhereHas('requisicione', function($qa){
                             $qa->where('correlativo', 'like', '%'.request('search').'%');
                         })
                         ->where('estatus', 'like', 'PR');
         },
         function ($query) {
             $query->where('estatus', 'like', 'PR')
             ->orderBy('id', 'DESC');
         })
        ->paginate(25)
        ->withQueryString();

        return view('analisi.procesadas', compact('analisis'))
            ->with('i', (request()->input('page', 1) - 1) * $analisis->perPage());
    }

    /**
     * Display requisiciones procesadas.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexaprobadas()
    {
        // $analisis = Analisi::where('estatus', 'AP')->paginate();

        $analisis = Analisi::query()
        ->when(request('search'), function($query){
            return $query->where ('id', 'like', '%'.request('search').'%')
                              ->where('estatus', 'like', 'AP')
                         ->orWhereHas('unidadadministrativa', function($q){
                          $q->where('unidadejecutora', 'like', '%'.request('search').'%');
                          })
                          ->where('estatus', 'like', 'AP')
                           ->orWhereHas('requisicione', function($qa){
                             $qa->where('correlativo', 'like', '%'.request('search').'%');
                         })
                         ->where('estatus', 'like', 'AP');
         },
         function ($query) {
             $query->where('estatus', 'like', 'AP')
             ->orderBy('id', 'DESC');
         })
        ->paginate(25)
        ->withQueryString();

        return view('analisi.aprobadas', compact('analisis'))
            ->with('i', (request()->input('page', 1) - 1) * $analisis->perPage());
    }

    /**
     * Display requisiciones anuladas.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexanuladas()
    {
      //  $analisis = Analisi::where('estatus', 'AN')->paginate();

      $analisis = Analisi::query()
        ->when(request('search'), function($query){
            return $query->where ('id', 'like', '%'.request('search').'%')
                              ->where('estatus', 'like', 'AN')
                         ->orWhereHas('unidadadministrativa', function($q){
                          $q->where('unidadejecutora', 'like', '%'.request('search').'%');
                          })
                          ->where('estatus', 'like', 'AN')
                           ->orWhereHas('requisicione', function($qa){
                             $qa->where('correlativo', 'like', '%'.request('search').'%');
                         })
                         ->where('estatus', 'like', 'AN');
         },
         function ($query) {
             $query->where('estatus', 'like', 'AN')
             ->orderBy('id', 'DESC');
         })
        ->paginate(25)
        ->withQueryString();

        return view('analisi.anuladas', compact('analisis'))
            ->with('i', (request()->input('page', 1) - 1) * $analisis->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $analisi = new Analisi();

        $unidadesadministrativas = Unidadadministrativa::pluck('unidadejecutora', 'id');

        $unidades = Unidadadministrativa::orderBy('sector', 'ASC')->get();

        $requisiciones = Requisicione::where('estatus','PR')->pluck('concepto', 'id');
        $criterios = Criterio::pluck('nombre', 'id');

        return view('analisi.create', compact('analisi', 'unidadesadministrativas', 'requisiciones', 'criterios', 'unidades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Analisi::$rules);

        //Agregar el id del usuario
        $id_usuario = $request->user()->id;
        $request->merge(['usuario_id'=>$id_usuario]);

        

        $analisi = Analisi::create($request->all());

        //Cambiar el estatus de la requisicion a aprobado, para que no vuelva a aparecer en el listado
        $requisicion = Requisicione::find($request->requisicion_id);
        $requisicion->estatus = 'AP';
        $requisicion->save();

        return redirect()->route('analisis.index')
            ->with('success', 'Analisis Creado Satisfactoriamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $analisi = Analisi::find($id);

        return view('analisi.show', compact('analisi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $analisi = Analisi::find($id);

        $unidadesadministrativas = Unidadadministrativa::pluck('unidadejecutora', 'id');
        $requisiciones = Requisicione::pluck('concepto', 'id');
        $criterios = Criterio::pluck('nombre', 'id');

        $unidades = Unidadadministrativa::all();

        return view('analisi.edit', compact('unidades', 'analisi', 'unidadesadministrativas', 'requisiciones', 'criterios'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Analisi $analisi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Analisi $analisi)
    {
        request()->validate(Analisi::$rules);

        $analisi->update($request->all());

        return redirect()->route('analisis.index')
            ->with('success', 'Analisi updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $analisi = Analisi::find($id)->delete();

        return redirect()->route('analisis.index')
            ->with('success', 'Analisi deleted successfully');
    }

    /**
     * @param int $id   CAMBIAR EL ESTATUS A ANULADO A UNA REQUISICION
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function anular($id)
    {
        $analisi = Analisi::find($id);
        $fecha = Carbon::now();
        $analisi->fechaanulacion = $fecha;
        $analisi->estatus = 'AN';
        $analisi->save();
        //Obtener la requisicion y colocarla en proceso nuevamente
        $requisicion_id = $analisi->requisicion_id;

        $requisicion = Requisicione::find($requisicion_id);
        $requisicion->estatus='EP';
        $requisicion->save();
        

        

        return redirect()->route('analisis.index')
            ->with('success', 'Analisis de Cotizacion Anulada exitosamente.');
    }

     /**
     * @param int $id   CAMBIAR EL ESTATUS A ANULADO A UNA REQUISICION
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function modificar($id)
    {
        $analisi = Analisi::find($id);
       
        $analisi->estatus = 'EP';
        $analisi->save();

        return redirect()->route('analisis.index')
            ->with('success', 'Analisis de Cotizacion Anulada exitosamente.');
    }

    //Metodo para aprobar un analisis de cotizacion
    /**
     * @param int $id   CAMBIAR EL ESTATUS A PROCESADO CUANDO YA ESTA aprobada la requisicion
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function aprobar($id)
    {
        $analisi = Analisi::find($id);


        //Antes de aprobar el analisis chequear que tengan detalles analisis

        $detalles_analisis = Detallesanalisi::where('analisis_id', $id)->exists();

        if($detalles_analisis==true){ 
            $analisi->estatus = 'PR';
            $analisi->save();
    
            return redirect()->route('analisis.index')
                ->with('success', 'Analisis de Cotizacion Procesada exitosamente.');

        }else{
            
    
            return redirect()->route('analisis.index')
                ->with('success', 'Error, no se puede aprobar el analisis, ya que no tiene ningun detalle agregado. Agregue detalles e intentelo nuevamente');
        }

      
    }

    /**
     * Display the specified resource agregar detalles a una requisicion.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function agregar($id)
    {
        $analisi = Analisi::find($id);

        $requisicion_id = $analisi->requisicion_id;


        //Creare una variable de sesion para guardar el id de esta requisicion
        session(['analisis_var' => $id]);

        $detallesrequisiciones = Detallesrequisicione::where('requisicion_id','=',$requisicion_id)->paginate();

        //Consulto los datos especificos para la requisicion seleccionada
        $detallesanalisis = Detallesanalisi::where('analisis_id','=',$id)->paginate();

        return view('analisi.agregar', compact('analisi', 'detallesanalisis', 'detallesrequisiciones'))
        ->with('i', (request()->input('page', 1) - 1) * $detallesanalisis->perPage());
    }

     /**
     * Crear pdf de la requisicion seleccionada
     *
     * @return \Illuminate\Http\Response
     */
    public function pdf($id)
    {
        
        $analisi = Analisi::find($id);

        $detallesanalisis = Detallesanalisi::where('analisis_id','=',$id)->get();
        $detalle = Detallesanalisi::where('analisis_id','=',$id)->first();

        $total = $detallesanalisis->sum('subtotal');



        //Obtener el proveedor
        $beneficiario = Beneficiario::find($detalle->beneficiario_id);


     

        $pdf = PDF::setPaper('letter', 'landscape')->loadView('analisi.pdf', ['total'=>$total,'beneficiario'=>$beneficiario, 'analisi'=>$analisi, 'detallesanalisis'=>$detallesanalisis]);
        return $pdf->stream();

        
    }

    
    

     //para llenar un select dinamico
     public function requisicion(Request $request){
        if(isset($request->texto)){
            $requis = Requisicione::where('unidadadministrativa_id', $request->texto)->where('estatus', 'PR')->get();
            return response()->json(
                [
                    'lista' => $requis,
                    'success' => true
                ]
                );
        }else{
            return response()->json(
                [
                    'success' => false
                ]
                );

        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        $analisi = new Analisi();

        $unidadesadministrativas = Unidadadministrativa::pluck('denominacion', 'id');

        $unidades = Unidadadministrativa::all();

        $requisiciones = Requisicione::where('estatus','PR')->pluck('concepto', 'id');
        $criterios = Criterio::pluck('nombre', 'id');

        return view('welcome', compact('analisi', 'unidadesadministrativas', 'requisiciones', 'criterios', 'unidades', 'created_at'));
    }

}
