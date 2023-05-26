<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Ajustescompromiso
 *
 * @property $id
 * @property $tipo
 * @property $compromiso_id
 * @property $documento
 * @property $concepto
 * @property $montoajuste
 * @property $created_at
 * @property $updated_at
 *
 * @property Compromiso $compromiso
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Ajustescompromiso extends Model
{
    
    static $rules = [
		'tipo' => 'required',
		'compromiso_id' => 'required',
		'documento' => 'required',
		'concepto' => 'required',
		'montoajuste' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['tipo','compromiso_id','documento','concepto','montoajuste', 'status', 'usuario_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function compromiso()
    {
        return $this->hasOne('App\Compromiso', 'id', 'compromiso_id');
    }
    
        public function usuario()
    {
        return $this->hasOne('App\Models\User', 'id', 'usuario_id');
    }

    public function scopeTipos($query, $tipo) {
    	if ($tipo) {
    		return $query->where('tipo','like',"$tipo");
    	}
    }

    public function scopeEstatus($query, $estatus) {
    	if ($estatus) {
    		return $query->where('status','like',"$estatus");
    	}
    }

    public function scopeUsuarios($query, $usuario) {
    	if ($usuario) {
    		return $query->where('usuario_id','like',"$usuario");
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
