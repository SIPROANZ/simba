<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Ejecucione
 *
 * @property $id
 * @property $ejercicio_id
 * @property $institucion_id
 * @property $unidadadministrativa_id
 * @property $meta_id
 * @property $clasificadorpresupuestario
 * @property $financiamiento_id
 * @property $monto_inicial
 * @property $monto_aumento
 * @property $monto_disminuye
 * @property $monto_actualizado
 * @property $monto_precomprometido
 * @property $monto_comprometido
 * @property $monto_causado
 * @property $monto_pagado
 * @property $monto_por_comprometer
 * @property $monto_por_causar
 * @property $monto_por_pagar
 * @property $poa_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Ejecuciondetalle[] $ejecuciondetalles
 * @property Ejercicio $ejercicio
 * @property Financiamiento $financiamiento
 * @property Institucione $institucione
 * @property Meta $meta
 * @property Poa $poa
 * @property Requidetclaspre[] $requidetclaspres
 * @property Unidadadministrativa $unidadadministrativa
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Ejecucione extends Model
{

    static $rules = [
		'ejercicio_id' => 'required',
		'institucion_id' => 'required',
		'unidadadministrativa_id' => 'required',
		'meta_id' => 'required',
		'clasificadorpresupuestario' => 'required',
		'financiamiento_id' => 'required',
		'monto_inicial' => 'required',
		'monto_aumento' => 'required',
		'monto_disminuye' => 'required',
		'monto_actualizado' => 'required',
		'monto_precomprometido' => 'required',
		'monto_comprometido' => 'required',
		'monto_causado' => 'required',
		'monto_pagado' => 'required',
		'monto_por_comprometer' => 'required',
		'monto_por_causar' => 'required',
		'monto_por_pagar' => 'required',
		'poa_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['ejercicio_id','institucion_id','unidadadministrativa_id','meta_id','clasificadorpresupuestario','financiamiento_id','monto_inicial','monto_aumento','monto_disminuye','monto_actualizado','monto_precomprometido','monto_comprometido','monto_causado','monto_pagado','monto_por_comprometer','monto_por_causar','monto_por_pagar','poa_id','usuario_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ejecuciondetalles()
    {
        return $this->hasMany('App\Ejecuciondetalle', 'ejecucion_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ejercicio()
    {
        return $this->hasOne('App\Ejercicio', 'id', 'ejercicio_id');
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function meta()
    {
        return $this->hasOne('App\Meta', 'id', 'meta_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function poa()
    {
        return $this->hasOne('App\Poa', 'id', 'poa_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function requidetclaspres()
    {
        return $this->hasMany('App\Requidetclaspre', 'ejecucion_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function unidadadministrativa()
    {
        return $this->hasOne('App\Unidadadministrativa', 'id', 'unidadadministrativa_id');
    }
    public function detallescompromiso()
    {
        return $this->hasOne('App\Detallescompromiso', 'id', 'ejecucion_id');
    }

    public function usuario()
    {
        return $this->hasOne('App\Models\User', 'id', 'usuario_id');
    }


}
