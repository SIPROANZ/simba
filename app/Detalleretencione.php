<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Detalleretencione
 *
 * @property $id
 * @property $retencion_id
 * @property $ordenpago_id
 * @property $montoneto
 * @property $montoIVA
 * @property $created_at
 * @property $updated_at
 *
 * @property Ordenpago $ordenpago
 * @property Retencione $retencione
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Detalleretencione extends Model
{

    static $rules = [
		'retencion_id' => 'required'
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['retencion_id','ordenpago_id','montoneto','montoIVA'];


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
    public function retencione()
    {
        return $this->hasOne('App\Retencione', 'id', 'retencion_id');
    }


}
