<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Ejecuciondetalle
 *
 * @property $id
 * @property $ejecucion_id
 * @property $periodofiscal
 * @property $institucion_id
 * @property $sector
 * @property $programa
 * @property $subprograma
 * @property $proyecto
 * @property $actividad
 * @property $cuenta
 * @property $financiamiento_id
 * @property $monto_inicial
 * @property $monto_aumento
 * @property $monto_disminucion
 * @property $monto_compromisos
 * @property $monto_causados
 * @property $monto_pagados
 * @property $logins
 * @property $unidadejecutora
 * @property $created_at
 * @property $updated_at
 *
 * @property Ejecucione $ejecucione
 * @property Financiamiento $financiamiento
 * @property Institucione $institucione
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Ejecuciondetalle extends Model
{
    
    static $rules = [
		'ejecucion_id' => 'required',
		'periodofiscal' => 'required',
		'institucion_id' => 'required',
		'sector' => 'required',
		'programa' => 'required',
		'subprograma' => 'required',
		'proyecto' => 'required',
		'actividad' => 'required',
		'cuenta' => 'required',
		'financiamiento_id' => 'required',
		'monto_inicial' => 'required',
		'monto_aumento' => 'required',
		'monto_disminucion' => 'required',
		'monto_compromisos' => 'required',
		'monto_causados' => 'required',
		'monto_pagados' => 'required',
		'logins' => 'required',
		'unidadejecutora' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['ejecucion_id','periodofiscal','institucion_id','sector','programa','subprograma','proyecto','actividad','cuenta','financiamiento_id','monto_inicial','monto_aumento','monto_disminucion','monto_compromisos','monto_causados','monto_pagados','logins','unidadejecutora'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ejecucione()
    {
        return $this->hasOne('App\Ejecucione', 'id', 'ejecucion_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function financiamiento()
    {
        return $this->hasOne('App\Financiamiento', 'id', 'financiamiento_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function institucione()
    {
        return $this->hasOne('App\Institucione', 'id', 'institucion_id');
    }
    

}
