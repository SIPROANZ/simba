<?php

namespace App\Http\Controllers;

use App\Notasdecredito;
use App\Ejercicio;
use App\Beneficiario;
use App\Institucione;
use App\Banco;
use App\Cuentasbancaria;
use Illuminate\Http\Request;

/**
 * Class NotasdecreditoController
 * @package App\Http\Controllers
 */
class NotasdecreditoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //  $notasdecreditos = Notasdecredito::paginate();

        $notasdecreditos = Notasdecredito::query()
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

        return view('notasdecredito.index', compact('notasdecreditos'))
            ->with('i', (request()->input('page', 1) - 1) * $notasdecreditos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $notasdecredito = new Notasdecredito();
        $ejercicios = Ejercicio::orderBy('id','DESC')->pluck('ejercicioejecucion', 'id');
        $instituciones = Institucione::pluck('institucion', 'id');
        $beneficiarios = Beneficiario::orderBy('nombre', 'ASC')->pluck('nombre', 'id');
        $bancos = Banco::all();


        return view('notasdecredito.create', compact('bancos', 'notasdecredito', 'ejercicios', 'instituciones', 'beneficiarios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Notasdecredito::$rules);

        //Agregar el id del usuario
        $id_usuario = $request->user()->id;
        $request->merge(['usuario_id'=>$id_usuario]);

        //Verificar que el numero de referencia y el bando no se repita
        $validar = Notasdecredito::where('cuentabancaria_id', $request->cuentabancaria_id)->where('referencia', $request->referencia)->exists();

        if($validar!= true){ $notasdecredito = Notasdecredito::create($request->all());
            //Obtener el id de la cuenta bancaria porque se le debe sumar el monto acreditado
            $cuentabancaria_id = $request->cuentabancaria_id;
    
            $cuentabanco = Cuentasbancaria::find($cuentabancaria_id);
            $cuentabanco->increment('montosaldo', $request->monto);
    
            
    
            return redirect()->route('notasdecreditos.index')
                ->with('success', 'Nota de credito creada satisfactoriamente.'); 
                }
                else
                {
                    return redirect()->route('notasdecreditos.index')
                ->with('success', 'Error: Numero de referencia esta repetida.'); 
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
        $notasdecredito = Notasdecredito::find($id);

        return view('notasdecredito.show', compact('notasdecredito'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $notasdecredito = Notasdecredito::find($id);
        $ejercicios = Ejercicio::orderBy('id','DESC')->pluck('ejercicioejecucion', 'id');
        $instituciones = Institucione::pluck('institucion', 'id');
        $beneficiarios = Beneficiario::orderBy('nombre', 'ASC')->pluck('nombre', 'id');
        $bancos = Banco::all();

        return view('notasdecredito.edit', compact('notasdecredito', 'bancos', 'ejercicios', 'instituciones', 'beneficiarios'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Notasdecredito $notasdecredito
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notasdecredito $notasdecredito)
    {
        request()->validate(Notasdecredito::$rules);

        //Obtengo el valor viejo el cual tengo  que decrementar y luego el valor nuevo lo ingreso
        $montoviejo = $notasdecredito->monto;
        $montonuevo = $request->monto;

        //Obtener el banco al cual quiero actualizar el valor
        $cuentabancaria = Cuentasbancaria::find($notasdecredito->cuentabancaria_id);
        $cuentabancaria->decrement('montosaldo', $montoviejo);
        $cuentabancaria->increment('montosaldo', $montonuevo);

        $notasdecredito->update($request->all());

        return redirect()->route('notasdecreditos.index')
            ->with('success', 'Nota de credito editada satisfactoriamente');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $notasdecredito = Notasdecredito::find($id);

        $cuenta = Cuentasbancaria::find($notasdecredito->cuentabancaria_id);
        $cuenta->decrement('montosaldo', $notasdecredito->monto);
        
        $notasdecredito->delete();

        return redirect()->route('notasdecreditos.index')
            ->with('success', 'Nota de credito eliminada satisfactoriamente');
    }

    //para llenar un select dinamico
    public function cuentas(Request $request){
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
