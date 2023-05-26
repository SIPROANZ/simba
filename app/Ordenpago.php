<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Ordenpago
 *
 * @property $id
 * @property $nordenpago
 * @property $beneficiario_id
 * @property $montobase
 * @property $montoretencion
 * @property $montoneto
 * @property $fechaanulacion
 * @property $status
 * @property $tipoorden
 * @property $montoiva
 * @property $montoexento
 * @property $compromiso_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Beneficiario $beneficiario
 * @property Compromiso $compromiso
 * @property Detalleordenpago[] $detalleordenpagos
 * @property Detallepagado[] $detallepagados
 * @property Detalleretencione[] $detalleretenciones
 * @property Pagado[] $pagados
 * @property Transferencia[] $transferencias
 * @property factura[] $factura
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Ordenpago extends Model
{

    static $rules = [
		'beneficiario_id' => 'required',
		'montobase' => 'required',
		'montoneto' => 'required',
		'tipoorden' => 'required',
		'montoiva' => 'required',
		'compromiso_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nordenpago','beneficiario_id','montobase','montoretencion','montoneto','fechaanulacion','status','tipoorden','montoiva','montoexento','compromiso_id', 'created_at','usuario_id'];


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
    public function compromiso()
    {
        return $this->hasOne('App\Compromiso', 'id', 'compromiso_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detalleordenpagos()
    {
        return $this->hasMany('App\Detalleordenpago', 'ordenpago_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detallepagados()
    {
        return $this->hasMany('App\Detallepagado', 'ordenpago_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detalleretenciones()
    {
        return $this->hasMany('App\Detalleretencione', 'ordenpago_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pagados()
    {
        return $this->hasMany('App\Pagado', 'ordenpago_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transferencias()
    {
        return $this->hasMany('App\Transferencia', 'ordenpago_id', 'id');
    }
    public function usuario()
    {
        return $this->hasOne('App\Models\User', 'id', 'usuario_id');
    }

    public function facturas()
    {
        return $this->hasMany('App\Factura', 'ordenpago_id', 'id');
    }
    
    public function scopeBeneficiarios($query, $beneficiario) {
    	if ($beneficiario) {
    		return $query->where('beneficiario_id','like',"$beneficiario");
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
