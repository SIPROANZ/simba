<?php

namespace App\Http\Controllers;

use App\Movimientosbancario;
use App\Ejercicio;
use App\Institucione;
use App\Cuentasbancaria;
use App\Beneficiario;
use App\Tipomovimiento;
use Illuminate\Http\Request;

/**
 * Class MovimientosbancarioController
 * @package App\Http\Controllers
 */
class MovimientosbancarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movimientosbancarios = Movimientosbancario::paginate();

        return view('movimientosbancario.index', compact('movimientosbancarios'))
            ->with('i', (request()->input('page', 1) - 1) * $movimientosbancarios->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $movimientosbancario = new Movimientosbancario();

        $ejercicios = Ejercicio::pluck('nombreejercicio' , 'id');
        $instituciones = Institucione::pluck('institucion', 'id');
        $cuentasbancarias = Cuentasbancaria::pluck('cuenta' , 'id');
        $beneficiarios = Beneficiario::pluck('nombre' , 'id');
        $tipomovimientos = Tipomovimiento::pluck('descripcion' , 'id');

        return view('movimientosbancario.create', compact('movimientosbancario', 'ejercicios' , 'instituciones' , 'cuentasbancarias', 'beneficiarios', 'tipomovimientos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Movimientosbancario::$rules);

        $movimientosbancario = Movimientosbancario::create($request->all());

        return redirect()->route('movimientosbancarios.index')
            ->with('success', 'Movimientosbancario created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movimientosbancario = Movimientosbancario::find($id);

        return view('movimientosbancario.show', compact('movimientosbancario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $movimientosbancario = Movimientosbancario::find($id);

        $ejercicios = Ejercicio::pluck('nombreejercicio' , 'id');
        $instituciones = Institucione::pluck('institucion', 'id');
        $cuentasbancarias = Cuentasbancaria::pluck('cuenta' , 'id');
        $beneficiarios = Beneficiario::pluck('nombre' , 'id');
        $tipomovimientos = Tipomovimiento::pluck('descripcion' , 'id');

        return view('movimientosbancario.edit', compact('movimientosbancario', 'ejercicios' , 'instituciones' , 'cuentasbancarias', 'beneficiarios', 'tipomovimientos'));
  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Movimientosbancario $movimientosbancario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movimientosbancario $movimientosbancario)
    {
        request()->validate(Movimientosbancario::$rules);

        $movimientosbancario->update($request->all());

        return redirect()->route('movimientosbancarios.index')
            ->with('success', 'Movimientosbancario updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $movimientosbancario = Movimientosbancario::find($id)->delete();

        return redirect()->route('movimientosbancarios.index')
            ->with('success', 'Movimientosbancario deleted successfully');
    }
}
