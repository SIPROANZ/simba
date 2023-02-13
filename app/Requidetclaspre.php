<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Requidetclaspre
 *
 * @property $id
 * @property $requisicion_id
 * @property $poa_id
 * @property $meta_id
 * @property $financiamiento_id
 * @property $disponible
 * @property $claspres
 * @property $ejecucion_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Ejecucione $ejecucione
 * @property Financiamiento $financiamiento
 * @property Meta $meta
 * @property Poa $poa
 * @property Requisicione $requisicione
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Requidetclaspre extends Model
{
    
    static $rules = [
		'requisicion_id' => 'required',
		'poa_id' => 'required',
		'meta_id' => 'required',
		'financiamiento_id' => 'required',
		'disponible' => 'required',
		'claspres' => 'required',
		'ejecucion_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['requisicion_id','poa_id','meta_id','financiamiento_id','disponible','claspres','ejecucion_id'];


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
    

}
