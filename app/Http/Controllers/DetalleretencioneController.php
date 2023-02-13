<?php

namespace App\Http\Controllers;

use App\Detalleretencione;
use App\Ordenpago;
use App\Retencione;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

/**
 * Class DetalleretencioneController
 * @package App\Http\Controllers
 */
class DetalleretencioneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $detalleretenciones = Detalleretencione::paginate();

        return view('detalleretencione.index', compact('detalleretenciones'))
            ->with('i', (request()->input('page', 1) - 1) * $detalleretenciones->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $detalleretencione = new Detalleretencione();
        //$retencione = Retencione::pluck('descripcion', 'id'); //Especificar mas

        $retencione = Retencione::select(
            DB::raw("CONCAT(descripcion,' ',porcentaje, '%') AS name"),'id')
            ->orderBy('name', 'ASC')
            ->pluck('name', 'id');




        return view('detalleretencione.create', compact('detalleretencione', 'retencione'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Detalleretencione::$rules);

        //Obtenemos los condiciones de la retencion para calcular

        $retencion = Retencione::find($request->retencion_id);
        $basecalculo = $retencion->base_calculo;
        $porcentaje = $retencion->porcentaje / 100;

        //Obtenemos los valores de la orden de pago para calcular

        $ordenpago = Ordenpago::find($request->ordenpago_id);
        $baseimponible = $ordenpago->montobase;
        $baseiva = $ordenpago->montoiva;

        if ($basecalculo == 1) {
            $retenido = $baseimponible * $porcentaje;

        } else {
            $retenido = $baseiva * $porcentaje;
        }

/*         $subtotal = $cantidad * $precio;
        $iva = $subtotal * 0.16;
        $total = $subtotal + $iva;
        $aprobado = $request->aprobado; */

        $datos_guardar = [
            'retencion_id' => $request->retencion_id,
            'ordenpago_id' => $request->ordenpago_id,
            'montoneto' => $retenido,
            'montoIVA' => $retenido,
        ];

        $datos_editar = [
            'montoretencion' => $ordenpago->montoretencion + $retenido,
            'montoneto' => $ordenpago->montoneto - $retenido,
        ];

        $detalleretencione = Detalleretencione::create($datos_guardar);

        $ordenpago->update($datos_editar);


        return redirect()->route('ordenpagos.agregar',$request->ordenpago_id)
            ->with('success', 'Retención Creada Exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detalleretencione = Detalleretencione::find($id);

        return view('detalleretencione.show', compact('detalleretencione'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $detalleretencione = Detalleretencione::find($id);

        $retencione = Retencione::select(
            DB::raw("CONCAT(descripcion,' ',porcentaje, '%') AS name"),'id')
            ->pluck('name', 'id');

        return view('detalleretencione.edit', compact('detalleretencione', 'retencione'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Detalleretencione $detalleretencione
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Detalleretencione $detalleretencione)
    {
        request()->validate(Detalleretencione::$rules);

        $detalleretencione->update($request->all());

        return redirect()->route('detalleretenciones.index')
            ->with('success', 'Detalleretencione updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $detalleretencione = Detalleretencione::find($id);
        $odp = $detalleretencione->ordenpago_id;

        //Obtenemos los valores de la orden de pago para recalcular

       $ordenpago = Ordenpago::find($odp);

       $datos_editar = [
        'montoretencion' => $ordenpago->montoretencion - $detalleretencione->montoneto,
        'montoneto' => $ordenpago->montoneto + $detalleretencione->montoneto,
    ];

        $ordenpago->update($datos_editar);

        $detalleretencione->delete();

        return redirect()->route('ordenpagos.agregar',$odp )
            ->with('success', 'Retención eliminada exitosamente');
    }
}
