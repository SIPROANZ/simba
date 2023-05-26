<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Transferenciaentrecuenta
 *
 * @property $id
 * @property $monto
 * @property $fecha
 * @property $referencia
 * @property $descripcion
 * @property $bancoorigen_id
 * @property $cuentaorigen_id
 * @property $bancodestino_id
 * @property $cuentadestino_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Banco $banco
 * @property Banco $banco
 * @property Cuentasbancaria $cuentasbancaria
 * @property Cuentasbancaria $cuentasbancaria
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Transferenciaentrecuenta extends Model
{
    
    static $rules = [
		'monto' => 'required',
		'fecha' => 'required',
		'referencia' => 'required',
		'descripcion' => 'required',
		'bancoorigen_id' => 'required',
		'cuentaorigen_id' => 'required',
		'bancodestino_id' => 'required',
		'cuentadestino_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['monto','fecha','referencia','descripcion','bancoorigen_id','cuentaorigen_id','bancodestino_id','cuentadestino_id','usuario_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function banco()
    {
        return $this->hasOne('App\Banco', 'id', 'bancoorigen_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function bancodestino()
    {
        return $this->hasOne('App\Banco', 'id', 'bancodestino_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function cuentasbancariadestino()
    {
        return $this->hasOne('App\Cuentasbancaria', 'id', 'cuentadestino_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function cuentasbancaria()
    {
        return $this->hasOne('App\Cuentasbancaria', 'id', 'cuentaorigen_id');
    }
    public function usuario()
    {
        return $this->hasOne('App\Models\User', 'id', 'usuario_id');
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
    		return $query->where('bancoorigen_id','like',"$bancos");
    	}
    }

    public function scopeCuentas($query, $cuenta) {
    	if ($cuenta) {
    		return $query->where('cuentaorigen_id','like',"$cuenta");
    	}
    }

    public function scopeBancosdest($query, $bancos) {
    	if ($bancos) {
    		return $query->where('bancodestino_id','like',"$bancos");
    	}
    }

    public function scopeCuentasdest($query, $cuenta) {
    	if ($cuenta) {
    		return $query->where('cuentadestino_id','like',"$cuenta");
    	}
    }

}
