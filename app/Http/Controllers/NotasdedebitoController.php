<?php

namespace App\Http\Controllers;

use App\Notasdedebito;
use App\Ejercicio;
use App\Beneficiario;
use App\Institucione;
use App\Banco;
use App\Cuentasbancaria;
use Illuminate\Http\Request;

/**
 * Class NotasdedebitoController
 * @package App\Http\Controllers
 */
class NotasdedebitoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // $notasdedebitos = Notasdedebito::paginate();

        $notasdedebitos = Notasdedebito::query()
       ->when(request('search'), function($query){
           return $query->where ('referencia', 'like', '%'.request('search').'%')
                        ->orWhere('descripcion', 'like', '%'.request('search').'%')
                        ->orWhereHas('banco', function($q){
                         $q->where('denominacion', 'like', '%'.request('search').'%');
                         })
                          ->orWhereHas('beneficiario', function($qa){
                            $qa->where('nombre', 'like', '%'.request('search').'%');
                        });
        },
        function ($query) {
            $query->orderBy('id', 'DESC');
        })
       ->paginate(25)
       ->withQueryString();

        return view('notasdedebito.index', compact('notasdedebitos'))
            ->with('i', (request()->input('page', 1) - 1) * $notasdedebitos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $notasdedebito = new Notasdedebito();

        $ejercicios = Ejercicio::orderBy('id','DESC')->pluck('ejercicioejecucion', 'id');
        $instituciones = Institucione::pluck('institucion', 'id');
        $beneficiarios = Beneficiario::orderBy('nombre', 'ASC')->pluck('nombre', 'id');
        $bancos = Banco::all();


        return view('notasdedebito.create', compact('notasdedebito', 'bancos', 'ejercicios', 'instituciones', 'beneficiarios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Notasdedebito::$rules);

        //Agregar el id del usuario
        $id_usuario = $request->user()->id;
        $request->merge(['usuario_id'=>$id_usuario]);
        
        //Verificar que el numero de referencia y el bando no se repita
        $validar = Notasdedebito::where('cuentabancaria_id', $request->cuentabancaria_id)->where('referencia', $request->referencia)->exists();

        if($validar!= true){ 

        $cuenta = Cuentasbancaria::find($request->cuentabancaria_id);
        $montosaldo = $cuenta->montosaldo;

        if($request->monto>$montosaldo) {
            return redirect()->route('notasdedebitos.index')
            ->with('success', 'Error: El monto a debitar es mayor al saldo de la cuenta bancaria.');
        }else{
           

            $notasdedebito = Notasdedebito::create($request->all());
            $cuenta->decrement('montosaldo', $request->monto);


        return redirect()->route('notasdedebitos.index')
            ->with('success', 'Nota de debito creada satisfactoriamente.');

        }

    }else {
        return redirect()->route('notasdedebitos.index')
            ->with('success', 'Error: El numero de referencia y cuenta bancaria se repite en el sistemna.');

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
        $notasdedebito = Notasdedebito::find($id);

        return view('notasdedebito.show', compact('notasdedebito'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $notasdedebito = Notasdedebito::find($id);

        $ejercicios = Ejercicio::orderBy('id','DESC')->pluck('ejercicioejecucion', 'id');
        $instituciones = Institucione::pluck('institucion', 'id');
        $beneficiarios = Beneficiario::orderBy('nombre', 'ASC')->pluck('nombre', 'id');
        $bancos = Banco::all();

        return view('notasdedebito.edit', compact('notasdedebito', 'bancos', 'ejercicios', 'instituciones', 'beneficiarios'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Notasdedebito $notasdedebito
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notasdedebito $notasdedebito)
    {
        request()->validate(Notasdedebito::$rules);


        //Codigo para editar
         //Obtengo el valor viejo el cual tengo  que decrementar y luego el valor nuevo lo ingreso
         $cuentabancaria = Cuentasbancaria::find($notasdedebito->cuentabancaria_id);
         $montoviejo = $notasdedebito->monto;
         $montonuevo = $request->monto;
 
         if($montonuevo>($montoviejo + $cuentabancaria->montosaldo) ) {
            return redirect()->route('notasdedebitos.index')
            ->with('success', 'Error: No se ha podido actualizar, porque el nuevo monto es mayor al saldo de la cuenta bancaria');
        }else{
           //Obtener el banco al cual quiero actualizar el valor
         $cuentabancaria->increment('montosaldo', $montoviejo);
         $cuentabancaria->decrement('montosaldo', $montonuevo);

        $notasdedebito->update($request->all());

        return redirect()->route('notasdedebitos.index')
            ->with('success', 'Nota de debito actualizada satisfactoriamente');

        }


    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $notasdedebito = Notasdedebito::find($id);
        
        $cuentabancaria = Cuentasbancaria::find($notasdedebito->cuentabancaria_id);
        $cuentabancaria->increment('montosaldo', $notasdedebito->monto);
       
        $notasdedebito->delete();

        return redirect()->route('notasdedebitos.index')
            ->with('success', 'Nota de debito eliminada satisfactoriamente');
    }

    //para llenar un select dinamico
    public function cuentasdeb(Request $request){
        if(isset($request->texto)){
            $cuentasbancarias = Cuentasbancaria::where('banco_id', $request->texto)
            ->orderBy('cuenta', 'ASC')
            ->get();
            return response()->json(
                [
                    'lista' => $cuentasbancarias,
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
