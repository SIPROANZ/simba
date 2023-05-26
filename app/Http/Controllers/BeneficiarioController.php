<?php

namespace App\Http\Controllers;

use App\Beneficiario;
use Illuminate\Http\Request;
use PDF;


/**
 * Class BeneficiarioController
 * @package App\Http\Controllers
 */
class BeneficiarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.beneficiarios')->only('index', 'edit', 'update', 'create', 'store');
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // $beneficiarios = Beneficiario::paginate();

        $beneficiarios = Beneficiario::query()
        ->when(request('search'), function($query){
            return $query->where('rif', 'like', '%'.request('search').'%')
                            ->orWhere('nombre', 'like', '%'.request('search').'%')
                         ->orWhereHas('usuario', function($q){
                          $q->where('name', 'like', '%'.request('search').'%');
                          })->orderBy('nombre', 'ASC');
         },
         function ($query) {
             $query->orderBy('nombre', 'ASC');
         })
        ->paginate(25)
        ->withQueryString();


        return view('beneficiario.index', compact('beneficiarios'))
            ->with('i', (request()->input('page', 1) - 1) * $beneficiarios->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $beneficiario = new Beneficiario();
        return view('beneficiario.create', compact('beneficiario'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Beneficiario::$rules);
        
        //Agregar el id del usuario
        $id_usuario = $request->user()->id;
        $request->merge(['usuario_id'=>$id_usuario]);

        $beneficiario = Beneficiario::create($request->all());

        return redirect()->route('beneficiarios.index')
            ->with('success', 'Beneficiario creado con exito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $beneficiario = Beneficiario::find($id);

        return view('beneficiario.show', compact('beneficiario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $beneficiario = Beneficiario::find($id);

        return view('beneficiario.edit', compact('beneficiario'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Beneficiario $beneficiario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Beneficiario $beneficiario)
    {
        request()->validate(Beneficiario::$rules);

        $beneficiario->update($request->all());

        return redirect()->route('beneficiarios.index')
            ->with('success', 'Beneficiario editado con exito');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $beneficiario = Beneficiario::find($id)->delete();

        return redirect()->route('beneficiarios.index')
            ->with('success', 'Beneficiario deleted successfully');
    }


    public function reportes()
    {
       return view('beneficiario.reportes');
    }

    public function reporte_pdf(Request $request)
    {
         //Buscar por institucion
         $direccion = $request->direccion;
         $persona = $request->persona;

        

        //direccion
        $beneficiarios = Beneficiario::direccion($direccion)->persona($persona)->get();
        $total_beneficiarios = count($beneficiarios);
        
        $datos = [
            'direccion' =>$direccion,  
            'total' => $total_beneficiarios,
            'caracterbeneficiario' => $persona,
            ]; 

        $pdf = PDF::setPaper('letter', 'landscape')->loadView('beneficiario.reportepdf', ['datos'=>$datos, 'beneficiarios'=>$beneficiarios]);
        return $pdf->stream();
         
    }
}
