<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Detallepagado
 *
 * @property $id
 * @property $pagado_id
 * @property $ordenpago_id
 * @property $unidadadministrativa_id
 * @property $ejecucion_id
 * @property $montopagado
 * @property $created_at
 * @property $updated_at
 *
 * @property Ejecucione $ejecucione
 * @property Ordenpago $ordenpago
 * @property Pagado $pagado
 * @property Unidadadministrativa $unidadadministrativa
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Detallepagado extends Model
{
    
    static $rules = [
		'pagado_id' => 'required',
		'ordenpago_id' => 'required',
		'unidadadministrativa_id' => 'required',
		'ejecucion_id' => 'required',
		'montopagado' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['pagado_id','ordenpago_id','unidadadministrativa_id','ejecucion_id','montopagado', 'montoabonado'];


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
    public function pagado()
    {
        return $this->hasOne('App\Pagado', 'id', 'pagado_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function unidadadministrativa()
    {
        return $this->hasOne('App\Unidadadministrativa', 'id', 'unidadadministrativa_id');
    }
    

}
