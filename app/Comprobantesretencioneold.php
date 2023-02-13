<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Comprobantesretencione
 *
 * @property $id
 * @property $tiporetencion_id
 * @property $ordenpago_id
 * @property $montoretencion
 * @property $created_at
 * @property $updated_at
 *
 * @property Ordenpago $ordenpago
 * @property Tiporetencione $tiporetencione
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Comprobantesretencione extends Model
{
    
    static $rules = [
		'tiporetencion_id' => 'required',
		'ordenpago_id' => 'required',
		'montoretencion' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['tiporetencion_id','ordenpago_id','montoretencion','status'];


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
    public function tiporetencione()
    {
        return $this->hasOne('App\Tiporetencione', 'id', 'tiporetencion_id');
    }
    

}
