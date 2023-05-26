<?php

namespace App\Http\Controllers;

use App\Detallesmodificacione;
use App\Ejecucione;
use App\Unidadadministrativa;
use App\Financiamiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class DetallesmodificacioneController
 * @package App\Http\Controllers
 */
class DetallesmodificacioneController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.modificacionpresupuestaria')->only('index', 'edit', 'update', 'create', 'store');
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $detallesmodificaciones = Detallesmodificacione::paginate();

        return view('detallesmodificacione.index', compact('detallesmodificaciones'))
            ->with('i', (request()->input('page', 1) - 1) * $detallesmodificaciones->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $detallesmodificacione = new Detallesmodificacione();
       // $unidadadministrativas = Unidadadministrativa::pluck('unidadejecutora', 'id');
        $unidadadministrativas = Unidadadministrativa::select(
            DB::raw("CONCAT(sector,'.',programa,'.',subprograma,'.',proyecto,'.',actividad,' ',unidadejecutora) AS name"),'id')
            ->orderBy('name', 'ASC')->get();

        $ejecuciones = Ejecucione::pluck('clasificadorpresupuestario', 'id');
        $modificacion_id = session('modificacion');
        
        $financiamientos = Financiamiento::all();
        
        $unidades = Unidadadministrativa::all();
        return view('detallesmodificacione.create', compact('financiamientos', 'unidades','modificacion_id', 'detallesmodificacione', 'unidadadministrativas', 'ejecuciones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Detallesmodificacione::$rules);
        $modificacion = session('modificacion');

        $request->merge(['modificacion_id'=>$modificacion]);

        $detallesmodificacione = Detallesmodificacione::create($request->all());
            
        /*
        return redirect()->route('detallesmodificaciones.index')
            ->with('success', 'Detallesmodificacione created successfully.');
                       */
            if(session()->has('modificacion')){
                return redirect()->route('modificaciones.agregarmodificacion',$modificacion)
                ->with('success', 'Registro Agregado Exitosamente. Desea agregar un nuevo registro. ');
            }else{
                return redirect()->route('modificaciones.index')
                ->with('success', 'Registro Agregado Exitosamente.');
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
        $detallesmodificacione = Detallesmodificacione::find($id);

        return view('detallesmodificacione.show', compact('detallesmodificacione'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $detallesmodificacione = Detallesmodificacione::find($id);
        $modificacion_id = session('modificacion');
       // $unidadadministrativas = Unidadadministrativa::pluck('unidadejecutora', 'id');
        $unidadadministrativas = Unidadadministrativa::select(
            DB::raw("CONCAT(sector,'.',programa,'.',subprograma,'.',proyecto,'.',actividad,' ',unidadejecutora) AS name"),'id')
            ->orderBy('name', 'ASC')->get();
        $ejecuciones = Ejecucione::pluck('clasificadorpresupuestario', 'id');
        $unidades = Unidadadministrativa::all();

        $financiamientos = Financiamiento::all();

        return view('detallesmodificacione.edit', compact('financiamientos', 'unidades', 'modificacion_id', 'detallesmodificacione', 'unidadadministrativas', 'ejecuciones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Detallesmodificacione $detallesmodificacione
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Detallesmodificacione $detallesmodificacione)
    {
        request()->validate(Detallesmodificacione::$rules);

        $detallesmodificacione->update($request->all());

     /*   return redirect()->route('detallesmodificaciones.index')
            ->with('success', 'Detallesmodificacione updated successfully');
     */     $modificacion = session('modificacion');
            if(session()->has('modificacion')){
                return redirect()->route('modificaciones.agregarmodificacion',$modificacion)
                ->with('success', 'Registro Agregado Exitosamente. Desea agregar un nuevo registro. ');
            }else{
                return redirect()->route('modificaciones.index')
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
        $detallesmodificacione = Detallesmodificacione::find($id)->delete();
        /*
        return redirect()->route('detallesmodificaciones.index')
            ->with('success', 'Detallesmodificacione deleted successfully');
        */
            $modificacion = session('modificacion');
            if(session()->has('modificacion')){
                return redirect()->route('modificaciones.agregarmodificacion',$modificacion)
                ->with('success', 'Registro Agregado Exitosamente. Desea agregar un nuevo registro. ');
            }else{
                return redirect()->route('modificaciones.index')
                ->with('success', 'Registro Agregado Exitosamente.');
            }
    }

    //para llenar un select dinamico
    public function ejecucionmod(Request $request){
        if(isset($request->texto)){
            $ejecuc = Ejecucione::where('unidadadministrativa_id', $request->texto)->get();
            return response()->json(
                [
                    'lista' => $ejecuc,
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
}
