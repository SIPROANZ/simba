<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Detallescompromiso
 *
 * @property $id
 * @property $montocompromiso
 * @property $compromiso_id
 * @property $unidadadministrativa_id
 * @property $ejecucion_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Compromiso $compromiso
 * @property Ejecucione $ejecucione
 * @property Unidadadministrativa $unidadadministrativa
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Detallescompromiso extends Model
{
    
    static $rules = [
		'montocompromiso' => 'required',
		'compromiso_id' => 'required',
		'unidadadministrativa_id' => 'required',
		'ejecucion_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['montocompromiso','compromiso_id','unidadadministrativa_id','ejecucion_id','financiamiento'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function compromiso()
    {
        return $this->hasOne('App\Compromiso', 'id', 'compromiso_id');
    }
    
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
    public function unidadadministrativa()
    {
        return $this->hasOne('App\Unidadadministrativa', 'id', 'unidadadministrativa_id');
    }

   
    

}
