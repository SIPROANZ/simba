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

}
