<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Requidetbo
 *
 * @property $id
 * @property $requisicion_id
 * @property $poa_id
 * @property $meta_id
 * @property $financiamiento_id
 * @property $bos_id
 * @property $undmedida_id
 * @property $claspres
 * @property $descripcion
 * @property $cantidad
 * @property $created_at
 * @property $updated_at
 *
 * @property Bo $bo
 * @property Financiamiento $financiamiento
 * @property Meta $meta
 * @property Poa $poa
 * @property Requisicione $requisicione
 * @property Unidadmedida $unidadmedida
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Requidetbo extends Model
{
    
    static $rules = [
		'requisicion_id' => 'required',
		'poa_id' => 'required',
		'meta_id' => 'required',
		'financiamiento_id' => 'required',
		'bos_id' => 'required',
		'undmedida_id' => 'required',
		'claspres' => 'required',
		'descripcion' => 'required',
		'cantidad' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['requisicion_id','poa_id','meta_id','financiamiento_id','bos_id','undmedida_id','claspres','descripcion','cantidad'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function bo()
    {
        return $this->hasOne('App\Bo', 'id', 'bos_id');
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
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function requisicione()
    {
        return $this->hasOne('App\Requisicione', 'id', 'requisicion_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function unidadmedida()
    {
        return $this->hasOne('App\Unidadmedida', 'id', 'undmedida_id');
    }
    

}
