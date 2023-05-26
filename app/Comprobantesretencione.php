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
 * @property $status
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
		'status' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['tiporetencion_id','detretencion_id','ordenpago_id','montoretencion','status','ncomprobante','created_at'];


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

    public function detretencione()
    {
        return $this->hasOne('App\Detalleretencione', 'id', 'detretencion_id');
    }

    public function scopeBeneficiarios($query, $beneficiario) {
    	if ($beneficiario) {
    		//return $query->where('beneficiario_id','like',"$beneficiario");

            return $query->whereHas('ordenpago', function($qa) use ($beneficiario) {
                $qa->where('beneficiario_id', 'like', "$beneficiario");
            });

    	}
    }

    public function scopeEstatus($query, $estatus) {
    	if ($estatus) {
    		return $query->where('status','like',"$estatus");
    	}
    }

    public function scopeTiporetencion($query, $tipo) {
    	if ($tipo) {
    		return $query->where('tiporetencion_id','like',"$tipo");
    	}
    }
    
    public function scopeFechaInicio($query, $inicio) {
    	if ($inicio) {
    		return $query->where('created_at','>=',"$inicio");
    	}
    }

    public function scopeFechaFin($query, $fin) {
    	if ($fin) {
    		return $query->where('created_at','<=',"$fin");
    	}
    }
    

}
