<?php

namespace App\Http\Controllers;

use App\Transferenciaentrecuenta;
use App\Banco;
use App\Cuentasbancaria;
use Illuminate\Http\Request;

/**
 * Class TransferenciaentrecuentaController
 * @package App\Http\Controllers
 */
class TransferenciaentrecuentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // $transferenciaentrecuentas = Transferenciaentrecuenta::paginate();

        $transferenciaentrecuentas = Transferenciaentrecuenta::query()
        ->when(request('search'), function($query){
            return $query->where('descripcion', 'like', '%'.request('search').'%')
                           ->orWhereHas('usuario', function($qa){
                             $qa->where('name', 'like', '%'.request('search').'%');
                         })->orderBy('id', 'DESC');
         },
         function ($query) {
             $query->orderBy('id', 'DESC');
         })
        ->paginate(25)
        ->withQueryString();

        return view('transferenciaentrecuenta.index', compact('transferenciaentrecuentas'))
            ->with('i', (request()->input('page', 1) - 1) * $transferenciaentrecuentas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $transferenciaentrecuenta = new Transferenciaentrecuenta();

        $bancos = Banco::all();
        $bancosdestino = Banco::all();
        return view('transferenciaentrecuenta.create', compact('transferenciaentrecuenta', 'bancos', 'bancosdestino'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Transferenciaentrecuenta::$rules);

        //Agregar el id del usuario
        $id_usuario = $request->user()->id;
        $request->merge(['usuario_id'=>$id_usuario]);
        
        $cuentaorigen = Cuentasbancaria::find($request->cuentaorigen_id);
        $cuentadestino = Cuentasbancaria::find($request->cuentadestino_id);
        $montosaldo = $cuentaorigen->montosaldo;

        $validar = Transferenciaentrecuenta::where('cuentaorigen_id', $request->cuentaorigen_id)->where('referencia', $request->referencia)->exists();


        if($validar!=true){ 

        if($request->monto>$montosaldo) {
            return redirect()->route('transferenciaentrecuentas.index')
            ->with('success', 'Error: El monto a transferir es mayor al saldo de la cuenta bancaria de origen.');
        
        }else{
           

            $transferenciaentrecuenta = Transferenciaentrecuenta::create($request->all());
            $cuentaorigen->decrement('montosaldo', $request->monto); //resto de la cuenta origen
            $cuentadestino->increment('montosaldo', $request->monto); //lo aumento en la cuenta destino

            return redirect()->route('transferenciaentrecuentas.index')
                ->with('success', 'Transferencia entre cuenta creada satisfactoriamente.');

        }
    }else{
        return redirect()->route('transferenciaentrecuentas.index')
                ->with('success', 'Error: La referencia bancaria se encuentra repetida en el sistema.');
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
        $transferenciaentrecuenta = Transferenciaentrecuenta::find($id);

        return view('transferenciaentrecuenta.show', compact('transferenciaentrecuenta'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $transferenciaentrecuenta = Transferenciaentrecuenta::find($id);

        $bancos = Banco::all();
        $bancosdestino = Banco::all();

        return view('transferenciaentrecuenta.edit', compact('transferenciaentrecuenta', 'bancos', 'bancosdestino'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Transferenciaentrecuenta $transferenciaentrecuenta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transferenciaentrecuenta $transferenciaentrecuenta)
    {
        request()->validate(Transferenciaentrecuenta::$rules);

         //Obtengo el valor viejo el cual tengo  que decrementar y luego el valor nuevo lo ingreso
         $cuentabancaria = Cuentasbancaria::find($transferenciaentrecuenta->cuentaorigen_id);
         $cuentabancariadestino = Cuentasbancaria::find($transferenciaentrecuenta->cuentadestino_id);
         $montoviejo = $transferenciaentrecuenta->monto;
         $montonuevo = $request->monto;
 
         if($montonuevo>($montoviejo + $cuentabancaria->montosaldo) ) {
            return redirect()->route('transferenciaentrecuentas.index')
            ->with('success', 'Error: No se ha podido actualizar, porque el nuevo monto es mayor al saldo de la cuenta bancaria de origen');
        }else{
           //Obtener el banco al cual quiero actualizar el valor
         $cuentabancaria->increment('montosaldo', $montoviejo);
         $cuentabancaria->decrement('montosaldo', $montonuevo);
         $cuentabancariadestino->decrement('montosaldo', $montoviejo);
         $cuentabancariadestino->increment('montosaldo', $montonuevo);

         $transferenciaentrecuenta->update($request->all());

        return redirect()->route('transferenciaentrecuentas.index')
            ->with('success', 'Transferencia entre cuentas actualizada satisfactoriamente');

        }

    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $transferenciaentrecuenta = Transferenciaentrecuenta::find($id);

        $cuentaorigen = Cuentasbancaria::find($transferenciaentrecuenta->cuentaorigen_id);
        $cuentaorigen->increment('montosaldo', $transferenciaentrecuenta->monto);

        $cuentadestino = Cuentasbancaria::find($transferenciaentrecuenta->cuentadestino_id);
        $cuentadestino->decrement('montosaldo', $transferenciaentrecuenta->monto);

        $transferenciaentrecuenta->delete();

        return redirect()->route('transferenciaentrecuentas.index')
            ->with('success', 'Transferencia entre cuenta eliminada satisfactoriamente');
    }

    public function cuentasorigen(Request $request){
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

    public function cuentasdestino(Request $request){
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
