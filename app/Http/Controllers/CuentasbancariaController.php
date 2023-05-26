<?php

namespace App\Http\Controllers;

use App\Cuentasbancaria;
use App\Banco;
use App\Institucione;
use Illuminate\Http\Request;
use PDF;

/**
 * Class CuentasbancariaController
 * @package App\Http\Controllers
 */
class CuentasbancariaController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.bancos')->only('index', 'edit', 'update', 'create', 'store');
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       //  $cuentasbancarias = Cuentasbancaria::paginate();

        $cuentasbancarias = Cuentasbancaria::query()
        ->when(request('search'), function($query){
            return $query->where ('cuenta', 'like', '%'.request('search').'%')
                              ->orWhere('descripcion', 'like', '%'.request('search').'%')
                         ->orWhereHas('banco', function($q){
                          $q->where('denominacion', 'like', '%'.request('search').'%');
                          });
         },
         function ($query) {
             $query->orderBy('id', 'DESC');
         })
         
        ->paginate(25)
        ->withQueryString();

        return view('cuentasbancaria.index', compact('cuentasbancarias'))
            ->with('i', (request()->input('page', 1) - 1) * $cuentasbancarias->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {  
        $cuentasbancaria = new Cuentasbancaria();
        $bancos = Banco::pluck('denominacion' , 'id');
        $instituciones = Institucione::pluck('institucion' , 'id');
        return view('cuentasbancaria.create', compact('cuentasbancaria','bancos', 'instituciones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Cuentasbancaria::$rules);

        $cuentasbancaria = Cuentasbancaria::create($request->all());

        return redirect()->route('cuentasbancarias.index')
            ->with('success', 'Cuentas bancaria creada exictosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cuentasbancaria = Cuentasbancaria::find($id);

        return view('cuentasbancaria.show', compact('cuentasbancaria'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cuentasbancaria = Cuentasbancaria::find($id);
        $bancos = Banco::pluck('denominacion' , 'id');
        $instituciones = Institucione::pluck('institucion' , 'id');
        return view('cuentasbancaria.edit', compact('cuentasbancaria','bancos', 'instituciones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Cuentasbancaria $cuentasbancaria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cuentasbancaria $cuentasbancaria)
    {
        request()->validate(Cuentasbancaria::$rules);

        $cuentasbancaria->update($request->all());

        return redirect()->route('cuentasbancarias.index')
            ->with('success', 'Cuentas bancaria editada exitosamente');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $cuentasbancaria = Cuentasbancaria::find($id)->delete();

        return redirect()->route('cuentasbancarias.index')
            ->with('success', 'Cuentas bancaria borrada exitosamente');
    }

    public function reportes()
    {
       
        $bancos = Banco::pluck('denominacion' , 'id');

        $cuentas = Cuentasbancaria::pluck('cuenta', 'id');


        return view('cuentasbancaria.reportes', compact('cuentas','bancos'));

            
    }

    public function reporte_pdf(Request $request)
    {   
        

        //Buscar por 
        $banco = $request->banco;
        $cuenta = $request->cuenta;
        
        $nombre_banco = '';
        $rs_banco= Banco::find($banco);
        if($rs_banco){
            $nombre_banco = $rs_banco->denominacion;
        }

        $nombre_cuenta = '';
        $rs_cuenta= Cuentasbancaria::find($cuenta);
        if($rs_cuenta){
            $nombre_cuenta = $rs_cuenta->cuenta;
        }

        //
        $cuentasbancarias = Cuentasbancaria::bancos($banco)->cuentas($cuenta)->get();
        $total_saldo = $cuentasbancarias->sum('montosaldo');
       

        $datos = [
             
            'nombre_banco' => $nombre_banco,
            'nombre_cuenta' => $nombre_cuenta,
            'total_saldo' => $total_saldo
            ]; 

        $pdf = PDF::setPaper('letter', 'landscape')->loadView('cuentasbancaria.reportepdf', ['datos'=>$datos, 'cuentasbancarias'=>$cuentasbancarias]);
        return $pdf->stream();
         
    }
}
