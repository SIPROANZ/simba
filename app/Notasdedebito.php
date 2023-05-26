<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Notasdedebito
 *
 * @property $id
 * @property $ejercicio_id
 * @property $institucion_id
 * @property $beneficiario_id
 * @property $banco_id
 * @property $cuentabancaria_id
 * @property $fecha
 * @property $referencia
 * @property $descripcion
 * @property $monto
 * @property $created_at
 * @property $updated_at
 *
 * @property Banco $banco
 * @property Beneficiario $beneficiario
 * @property Cuentasbancaria $cuentasbancaria
 * @property Ejercicio $ejercicio
 * @property Institucione $institucione
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Notasdedebito extends Model
{
    
    static $rules = [
		'ejercicio_id' => 'required',
		'institucion_id' => 'required',
		'beneficiario_id' => 'required',
		'banco_id' => 'required',
		'cuentabancaria_id' => 'required',
		'referencia' => 'required',
		'descripcion' => 'required',
		'monto' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['ejercicio_id','institucion_id','beneficiario_id','banco_id','cuentabancaria_id','fecha','referencia','descripcion','monto','usuario_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function banco()
    {
        return $this->hasOne('App\Banco', 'id', 'banco_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function beneficiario()
    {
        return $this->hasOne('App\Beneficiario', 'id', 'beneficiario_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function cuentasbancaria()
    {
        return $this->hasOne('App\Cuentasbancaria', 'id', 'cuentabancaria_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ejercicio()
    {
        return $this->hasOne('App\Ejercicio', 'id', 'ejercicio_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function institucione()
    {
        return $this->hasOne('App\Institucione', 'id', 'institucion_id');
    }
    public function usuario()
    {
        return $this->hasOne('App\Models\User', 'id', 'usuario_id');
    }  

    public function scopeInstitucion($query, $institucion) {
    	if ($institucion) {
    		return $query->where('institucion_id','like',"$institucion");
    	}
    }

    public function scopeEjercicio($query, $ejercicio) {
    	if ($ejercicio) {
    		return $query->where('ejercicio_id','like',"$ejercicio");
    	}
    }

    public function scopeUsuarios($query, $usuario) {
    	if ($usuario) {
    		return $query->where('usuario_id','like',"$usuario");
    	}
    }

    public function scopeFechaInicio($query, $inicio) {
    	if ($inicio) {
    		return $query->where('fecha','>=',"$inicio");
    	}
    }

    public function scopeFechaFin($query, $fin) {
    	if ($fin) {
    		return $query->where('fecha','<=',"$fin");
    	}
    }

    public function scopeBeneficiarios($query, $beneficiario) {
    	if ($beneficiario) {
    		return $query->where('beneficiario_id','like',"$beneficiario");
    	}
    }

    public function scopeBancos($query, $bancos) {
    	if ($bancos) {
    		return $query->where('banco_id','like',"$bancos");
    	}
    }

    public function scopeCuentas($query, $cuenta) {
    	if ($cuenta) {
    		return $query->where('cuentabancaria_id','like',"$cuenta");
    	}
    }

}
