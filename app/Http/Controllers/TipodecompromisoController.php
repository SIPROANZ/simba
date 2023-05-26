<?php

namespace App\Http\Controllers;

use App\Tipodecompromiso;
use Illuminate\Http\Request;

/**
 * Class TipodecompromisoController
 * @package App\Http\Controllers
 */
class TipodecompromisoController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.compromisos')->only('index', 'edit', 'update', 'create', 'store');
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // $tipodecompromisos = Tipodecompromiso::paginate();

        $tipodecompromisos = Tipodecompromiso::query()
        ->when(request('search'), function($query){
            return $query->where('nombre', 'like', '%'.request('search').'%');
         })
        ->orderBy('nombre', 'ASC')
        ->paginate(25)
        ->withQueryString();

        return view('tipodecompromiso.index', compact('tipodecompromisos'))
            ->with('i', (request()->input('page', 1) - 1) * $tipodecompromisos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipodecompromiso = new Tipodecompromiso();
        return view('tipodecompromiso.create', compact('tipodecompromiso'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Tipodecompromiso::$rules);

        //Agregar el id del usuario
        $id_usuario = $request->user()->id;
        $request->merge(['usuario_id'=>$id_usuario]);

        $tipodecompromiso = Tipodecompromiso::create($request->all());

        return redirect()->route('tipodecompromisos.index')
            ->with('success', 'Tipo de Compromiso Registrado con Exito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipodecompromiso = Tipodecompromiso::find($id);

        return view('tipodecompromiso.show', compact('tipodecompromiso'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipodecompromiso = Tipodecompromiso::find($id);

        return view('tipodecompromiso.edit', compact('tipodecompromiso'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Tipodecompromiso $tipodecompromiso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tipodecompromiso $tipodecompromiso)
    {
        request()->validate(Tipodecompromiso::$rules);

        $tipodecompromiso->update($request->all());

        return redirect()->route('tipodecompromisos.index')
            ->with('success', 'Tipo de Compromiso Editado satisfactoriamente');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $tipodecompromiso = Tipodecompromiso::find($id)->delete();

        return redirect()->route('tipodecompromisos.index')
            ->with('success', 'Tipo de Compromiso Eliminado Satisfactoriamente');
    }
}
