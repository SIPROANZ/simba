<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Factura
 *
 * @property $id
 * @property $ordenpago_id
 * @property $numero_factura
 * @property $numero_control
 * @property $fecha
 * @property $montobase
 * @property $montoiva
 * @property $montototal
 * @property $created_at
 * @property $updated_at
 *
 * @property Ordenpago $ordenpago
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Factura extends Model
{
    
    static $rules = [
		'ordenpago_id' => 'required',
		'numero_factura' => 'required',
		'numero_control' => 'required',
		'montobase' => 'required',
		'montoiva' => 'required',
		'montototal' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['ordenpago_id','numero_factura','numero_control','fecha','montobase','montoiva','montototal','usuario_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ordenpago()
    {
        return $this->hasOne('App\Ordenpago', 'id', 'ordenpago_id');
    }
    public function usuario()
    {
        return $this->hasOne('App\Models\User', 'id', 'usuario_id');
    }   

}
