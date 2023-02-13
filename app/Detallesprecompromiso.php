<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Detallesprecompromiso
 *
 * @property $id
 * @property $montocompromiso
 * @property $precompromiso_id
 * @property $unidadadministrativa_id
 * @property $ejecucion_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Ejecucione $ejecucione
 * @property Precompromiso $precompromiso
 * @property Unidadadministrativa $unidadadministrativa
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Detallesprecompromiso extends Model
{
    
    static $rules = [
		'montocompromiso' => 'required',
		'precompromiso_id' => 'required',
		'unidadadministrativa_id' => 'required',
		'ejecucion_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['montocompromiso','precompromiso_id','unidadadministrativa_id','ejecucion_id', 'financiamiento'];


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
    public function precompromiso()
    {
        return $this->hasOne('App\Precompromiso', 'id', 'precompromiso_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function unidadadministrativa()
    {
        return $this->hasOne('App\Unidadadministrativa', 'id', 'unidadadministrativa_id');
    }
    

}
