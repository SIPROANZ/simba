<?php

namespace App\Http\Controllers;

use App\Unidadadministrativa;
use App\Ejercicio;
use App\institucione;
use Illuminate\Http\Request;

/**
 * Class UnidadadministrativaController
 * @package App\Http\Controllers
 */
class UnidadadministrativaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$unidadadministrativas = Unidadadministrativa::paginate();

        $unidadadministrativas = Unidadadministrativa::query()
        ->when(request('search'), function($query){
            return $query->where('denominacion', 'like', '%'.request('search').'%')
                            ->orWhere('unidadejecutora', 'like', '%'.request('search').'%')
                         ->orWhereHas('usuario', function($q){
                          $q->where('name', 'like', '%'.request('search').'%');
                          })->orderBy('unidadejecutora', 'DESC');
         },
         function ($query) {
             $query->orderBy('unidadejecutora', 'ASC');
         })
        ->paginate(25)
        ->withQueryString();

        return view('unidadadministrativa.index', compact('unidadadministrativas'))
            ->with('i', (request()->input('page', 1) - 1) * $unidadadministrativas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $unidadadministrativa = new Unidadadministrativa();
        $ejercicio = Ejercicio::pluck('nombreejercicio', 'id'); 
        $instituciones = Institucione::pluck('institucion', 'id');
        return view('unidadadministrativa.create', compact('unidadadministrativa' , 'ejercicio', 'instituciones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Unidadadministrativa::$rules);

        //Agregar el id del usuario
        $id_usuario = $request->user()->id;
        $request->merge(['usuario_id'=>$id_usuario]);

        $unidadadministrativa = Unidadadministrativa::create($request->all());

        return redirect()->route('unidadadministrativas.index')
            ->with('success', 'Unidad administrativa creada con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $unidadadministrativa = Unidadadministrativa::find($id);

        return view('unidadadministrativa.show', compact('unidadadministrativa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $unidadadministrativa = Unidadadministrativa::find($id);
        $ejercicio = Ejercicio::pluck('nombreejercicio', 'id'); 

        $instituciones = Institucione::pluck('institucion', 'id');

        return view('unidadadministrativa.edit', compact('unidadadministrativa', 'ejercicio', 'instituciones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Unidadadministrativa $unidadadministrativa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Unidadadministrativa $unidadadministrativa)
    {
        request()->validate(Unidadadministrativa::$rules);

        $unidadadministrativa->update($request->all());

        return redirect()->route('unidadadministrativas.index')
            ->with('success', 'Unidad administrativa actualilzada con éxito');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $unidadadministrativa = Unidadadministrativa::find($id)->delete();

        return redirect()->route('unidadadministrativas.index')
            ->with('success', 'Unidad administrativa eliminada con éxito');
    }
}
