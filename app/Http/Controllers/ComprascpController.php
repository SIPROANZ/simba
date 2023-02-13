<?php

namespace App\Http\Controllers;

use App\Comprascp;
use App\Compra;
use App\Unidadadministrativa;
use App\Ejecucione;
use App\Analisi;
use App\Detallesanalisi;
use App\Beneficiario;
use App\Requisicione;
use Illuminate\Http\Request;

/**
 * Class ComprascpController
 * @package App\Http\Controllers
 */
class ComprascpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comprascps = Comprascp::paginate();

        return view('comprascp.index', compact('comprascps'))
            ->with('i', (request()->input('page', 1) - 1) * $comprascps->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $comprascp = new Comprascp();
        return view('comprascp.create', compact('comprascp'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Comprascp::$rules);

        $comprascp = Comprascp::create($request->all());

        return redirect()->route('comprascps.index')
            ->with('success', 'Comprascp created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comprascp = Comprascp::find($id);

        return view('comprascp.show', compact('comprascp'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comprascp = Comprascp::find($id);

        $unidad_administrativa = Unidadadministrativa::pluck('unidadejecutora','id');
        $ejecuciones = Ejecucione::pluck('clasificadorpresupuestario','id');

        return view('comprascp.edit', compact('comprascp', 'unidad_administrativa', 'ejecuciones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Comprascp $comprascp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comprascp $comprascp)
    {
        request()->validate(Comprascp::$rules);

        $comprascp->update($request->all());
        
               if(session()->has('mostrarcompra')){
                $id = session('mostrarcompra');
                $compra = Compra::find($id);
                $comprascps = Comprascp::where('compra_id', $id)->paginate();

                //Inicio de codigo
                //Obtener el numero de la requisicion
        $analisis = Analisi::find($compra->analisis_id);
        $requisicion_id = $analisis->requisicion_id;
        $unidadadministrativa_id = $analisis->unidadadministrativa_id;
        $requisicion = Requisicione::find($requisicion_id);
        $correlativo = $requisicion->correlativo;
        $uso = $requisicion->uso;
        $undadm = Unidadadministrativa::find($unidadadministrativa_id);
        $departamento = $undadm->unidadejecutora;
        $sub_sector = $undadm->denominacion;
        $sector_actual = $undadm->sector;

        //Para obtener el sector
        $nuevo_sector = Unidadadministrativa::where('sector', $sector_actual )->where('programa', '00')->first();
        $sector = $nuevo_sector->unidadejecutora;

        //PARA OBTENER EL ID DEL PROVEEDOR
        $proveedor = Detallesanalisi::where('analisis_id', $analisis->id)->where('aprobado', 'SI')->first();
        $proveedor_id = $proveedor->proveedor_id;
        //Ahora busco la razon social y el rif
        $beneficiario = Beneficiario::find($proveedor_id);
        $rif =$beneficiario->caracterbeneficiario . '-' . $beneficiario->rif;
        $razon_social = $beneficiario->nombre;

        //Para ver los detalles de la compra
        //Consulto los datos especificos para la requisicion seleccionada
        $detallesanalisis = Detallesanalisi::where('analisis_id',$analisis->id)->paginate();
                //Fin de Codigo
    
           // return view('compra.show', compact('compra'));
    
            return view('compra.show', compact('compra', 'detallesanalisis', 'comprascps', 'correlativo', 'departamento', 'uso', 'sub_sector', 'sector', 'rif', 'razon_social'))
                ->with('i', (request()->input('page', 1) - 1) * $comprascps->perPage());
            }else{
                return redirect()->route('compra.index')
                ->with('success', 'Registro Agregado Exitosamente.');
            } 
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $comprascp = Comprascp::find($id)->delete();

        return redirect()->route('comprascps.index')
            ->with('success', 'Comprascp deleted successfully');
    }
}
