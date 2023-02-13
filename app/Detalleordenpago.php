<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Detalleordenpago
 *
 * @property $id
 * @property $ordenpago_id
 * @property $unidadadministrativa_id
 * @property $ejecucion_id
 * @property $monto
 * @property $created_at
 * @property $updated_at
 *
 * @property Ejecucione $ejecucione
 * @property Ordenpago $ordenpago
 * @property Unidadadministrativa $unidadadministrativa
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Detalleordenpago extends Model
{
    
    static $rules = [
		'ordenpago_id' => 'required',
		'unidadadministrativa_id' => 'required',
		'ejecucion_id' => 'required',
		'monto' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['ordenpago_id','unidadadministrativa_id','ejecucion_id','monto'];


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
    public function ordenpago()
    {
        return $this->hasOne('App\Ordenpago', 'id', 'ordenpago_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function unidadadministrativa()
    {
        return $this->hasOne('App\Unidadadministrativa', 'id', 'unidadadministrativa_id');
    }
    

}
