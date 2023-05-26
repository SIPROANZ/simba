<?php

namespace App\Http\Controllers;

use App\Comprobantesretencione;
use App\Factura;
use App\Compra;
use App\Analisi;
use App\Requisicione;
use Illuminate\Http\Request;
use App\Compromiso;
use PDF;
USE App\Retencione;
USE App\Tiporetencione;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use App\Beneficiario;

/**
 * Class ComprobantesretencioneController
 * @package App\Http\Controllers
 */
class ComprobantesretencioneController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.pagados')->only('index', 'edit', 'update', 'create', 'store');
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       //  $comprobantesretenciones = Comprobantesretencione::paginate();

        $comprobantesretenciones = Comprobantesretencione::query()
        ->when(request('search'), function($query){
            return $query->where ('id', 'like', '%'.request('search').'%')
                              ->orWhere('status', 'like', '%'.request('search').'%')
                         ->orWhereHas('ordenpago', function($q){
                          $q->where('nordenpago', 'like', '%'.request('search').'%');
                          })
                          ->orWhereHas('tiporetencione', function($q){
                            $q->where('tipo', 'like', '%'.request('search').'%');
                            })
                          ;
         },
         function ($query) {
             $query->orderBy('id', 'DESC');
         })
         
        ->paginate(25)
        ->withQueryString();

        return view('comprobantesretencione.index', compact('comprobantesretenciones'))
            ->with('i', (request()->input('page', 1) - 1) * $comprobantesretenciones->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $comprobantesretencione = new Comprobantesretencione();
        return view('comprobantesretencione.create', compact('comprobantesretencione'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Comprobantesretencione::$rules);

       

        $comprobantesretencione = Comprobantesretencione::create($request->all());

        return redirect()->route('comprobantesretenciones.index')
            ->with('success', 'Comprobantesretencione created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comprobantesretencione = Comprobantesretencione::find($id);

        return view('comprobantesretencione.show', compact('comprobantesretencione'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comprobantesretencione = Comprobantesretencione::find($id);

        return view('comprobantesretencione.edit', compact('comprobantesretencione'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Comprobantesretencione $comprobantesretencione
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comprobantesretencione $comprobantesretencione)
    {
        request()->validate(Comprobantesretencione::$rules);

        $comprobantesretencione->update($request->all());

        return redirect()->route('comprobantesretenciones.index')
            ->with('success', 'Comprobante de retencion Actualizado Satisfactoriamente');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $comprobantesretencione = Comprobantesretencione::find($id)->delete();

        return redirect()->route('comprobantesretenciones.index')
            ->with('success', 'Comprobantesretencione deleted successfully');
    }

    public function islrpdf($id)
    {
        
        $comprobantesretencione = Comprobantesretencione::find($id);

        $monto_retencion = $comprobantesretencione->montoretencion;

        $tipo_retencion =  $comprobantesretencione->tiporetencion_id;

        //Obtener la primera factura, un solo registro
        $num_factura = Factura::where('ordenpago_id', $comprobantesretencione->ordenpago_id)->first();
        $concepto = '';

        //Obtener todas las facturas
        $total_facturas = Factura::where('ordenpago_id', $comprobantesretencione->ordenpago_id)->get();

        


        $rs_alicuota = 1;

        if($tipo_retencion == 1) { //iva
            $pdf = PDF::setPaper('letter', 'landscape')->loadView('comprobantesretencione.ivapdf', ['comprobantesretencione'=>$comprobantesretencione, 'monto_retencion'=>$monto_retencion, 'facturas'=>$total_facturas]);
            return $pdf->stream();  
        }elseif($tipo_retencion == 2) { //islR
            $pdf = PDF::setPaper('letter', 'landscape')->loadView('comprobantesretencione.islrpdf', ['comprobantesretencione'=>$comprobantesretencione, 'facturas'=>$total_facturas]);
            return $pdf->stream();  
        }
        elseif($tipo_retencion == 3) { //nomina este formulario no se utiliza mucho
            $pdf = PDF::setPaper('letter', 'landscape')->loadView('comprobantesretencione.nominapdf', ['comprobantesretencione'=>$comprobantesretencione]);
            return $pdf->stream();  
        }
        elseif($tipo_retencion == 4) { //timbrefiscal

            $monto_total_grabable = $comprobantesretencione->ordenpago->montobase + $comprobantesretencione->ordenpago->montoiva;

            //inicio de concepto
        $compromiso = Compromiso::find($comprobantesretencione->ordenpago->compromiso_id);

        if($compromiso->precompromiso_id != NULL){

            $concepto = $compromiso->precompromiso->concepto;

        }
        elseif($compromiso->ayuda_id != NULL){

            $concepto = $compromiso->ayudassociale->concepto;
   
        }
        elseif($compromiso->compra_id != NULL){

            $compra_id = $compromiso->compra_id;
            $rs_compra = Compra::find($compra_id);
            $analisis_id = $rs_compra->analisis_id;
            $rs_analisis = Analisi::find($analisis_id);
            $requisicion_id = $rs_analisis->requisicion_id;
            $rs_requisicion = Requisicione::find($requisicion_id);
            $concepto = $rs_requisicion->concepto;   
        }
        //Fin de concepto

            $pdf = PDF::setPaper('letter', 'portrait')->loadView('comprobantesretencione.timbrefiscalpdf', ['monto_total_grabable'=>$monto_total_grabable,'comprobantesretencione'=>$comprobantesretencione, 'num_factura'=>$num_factura, 'concepto'=>$concepto, 'facturas'=>$total_facturas]);
            return $pdf->stream();  
        }

        elseif($tipo_retencion == 5) { //negroprimero
            $pdf = PDF::setPaper('letter', 'landscape')->loadView('comprobantesretencione.negropdf', ['comprobantesretencione'=>$comprobantesretencione, 'facturas'=>$total_facturas]);
            return $pdf->stream();  
        }

        elseif($tipo_retencion == 6) { //IMPUESTO MUNICIPAL
            $pdf = PDF::setPaper('letter', 'landscape')->loadView('comprobantesretencione.actiecopdf', ['comprobantesretencione'=>$comprobantesretencione, 'facturas'=>$total_facturas]);
            return $pdf->stream();  
        }

        
    }

    public function reportes()
    {
       
       /* $retenciones = Retencione::select(
            DB::raw("CONCAT(descripcion,' ',porcentaje, '%') AS name"),'id')
            ->orderBy('name', 'ASC')
            ->pluck('name', 'id'); // Retencione::orderBy('descripcion', 'ASC')->pluck('descripcion', 'id');
        */

        $retenciones = Tiporetencione::pluck('tipo', 'id');

        $fecha_actual = Carbon::now();
      

        return view('comprobantesretencione.reportes', compact('fecha_actual','retenciones'));

            
    }

    public function reporte_pdf(Request $request)
    {
        //Buscar por institucion
        $rif = $request->rif;

        //Obtener Beneficiario
        $beneficiario_id = false;
        $nombre_beneficiario = '';
        $rs_beneficiario = Beneficiario::where('rif', $rif)->first();
        if($rs_beneficiario){
            $beneficiario_id = $rs_beneficiario->id;
            $nombre_beneficiario = $rs_beneficiario->nombre;
        }
        
        $retencion = $request->retencion_id;

        $nombre_retencion = '';
        $rs_retencion = Tiporetencione::find($retencion);
        if($rs_retencion){
            $nombre_retencion = $rs_retencion->tipo;
        }
        

        
        $estatus = $request->status;
        $nombre_estatus = '';
        if($estatus == 'EP')
        {
            $nombre_estatus = 'EN PROCESO';
        }elseif($estatus == 'AP'){
            $nombre_estatus = 'ENTREGADO';
        }elseif($estatus == 'PR'){
            $nombre_estatus = 'PROCESADO';
        }elseif($estatus == 'AN'){
            $nombre_estatus = 'ANULADO';
        }
        
        $inicio = $request->fecha_inicio;
        $fin = $request->fecha_fin;
        
        $comprobantesretenciones = Comprobantesretencione::beneficiarios($beneficiario_id)->tiporetencion($retencion)->estatus($estatus)->fechaInicio($inicio)->fechaFin($fin)->get();
        $total_bs = $comprobantesretenciones->sum('montoretencion');
        $aprobadas = Comprobantesretencione::where('status', 'AP')->beneficiarios($beneficiario_id)->tiporetencion($retencion)->estatus($estatus)->fechaInicio($inicio)->fechaFin($fin)->count();
        $procesadas = Comprobantesretencione::where('status', 'PR')->beneficiarios($beneficiario_id)->tiporetencion($retencion)->estatus($estatus)->fechaInicio($inicio)->fechaFin($fin)->count();
        $enproceso = Comprobantesretencione::where('status', 'EP')->beneficiarios($beneficiario_id)->tiporetencion($retencion)->estatus($estatus)->fechaInicio($inicio)->fechaFin($fin)->count();
        $anuladas = Comprobantesretencione::where('status', 'AN')->beneficiarios($beneficiario_id)->tiporetencion($retencion)->estatus($estatus)->fechaInicio($inicio)->fechaFin($fin)->count();
        $total = Comprobantesretencione::beneficiarios($beneficiario_id)->tiporetencion($retencion)->estatus($estatus)->fechaInicio($inicio)->fechaFin($fin)->count();
       
        $datos = [
            
            'aprobadas' => $aprobadas,
            'procesadas' => $procesadas,
            'enproceso' => $enproceso,
            'anuladas' => $anuladas,
            'total' => $total, 
            
            'inicio' => $inicio,
            'fin' => $fin,  
            'nombre_retencion' =>$nombre_retencion,  
            'estatus' =>$nombre_estatus,  
            'beneficiario' => $nombre_beneficiario,
            'total_bs' => $total_bs
            ]; 

        $pdf = PDF::setPaper('letter', 'landscape')->loadView('comprobantesretencione.reportepdf', ['datos'=>$datos, 'comprobantesretenciones'=>$comprobantesretenciones]);
        return $pdf->stream();
        
         
    }


}
