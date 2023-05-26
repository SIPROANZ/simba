<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Pagado
 *
 * @property $id
 * @property $ordenpago_id
 * @property $beneficiario_id
 * @property $tipomovimiento_id
 * @property $montopagado
 * @property $fechaanulacion
 * @property $status
 * @property $correlativo
 * @property $tipoordenpago
 * @property $created_at
 * @property $updated_at
 * 
 * @property Tipomovimiento $tipomovimiento
 * @property Beneficiario $beneficiario
 * @property Ordenpago $ordenpago
 *  @property Transferencia[] $transferencias
 * @property Transferencia[] $detallepagados
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Pagado extends Model
{

    static $rules = [
		'ordenpago_id' => 'required',
		'beneficiario_id' => 'required',
        'tipomovimiento_id' => 'required',
		'status' => 'required',
		'tipoordenpago' => 'required',
       
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['ordenpago_id','beneficiario_id', 'tipomovimiento_id','montopagado','montoordenpago','fechaanulacion','status','tipoordenpago' ,'correlativo','usuario_id', 'created_at'];


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
    public function ordenpago()
    {
        return $this->hasOne('App\Ordenpago', 'id', 'ordenpago_id');
    }
    
     /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tipomovimiento()
    {
        return $this->hasOne('App\Tipomovimiento', 'id', 'tipomovimiento_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transferencias()
    {
        return $this->hasMany('App\Transferencia', 'pagado_id', 'id');
    }

     /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detallepagados()
    {
        return $this->hasMany('App\Detallepagado', 'pagado_id', 'id');
    }

    public function usuario()
    {
        return $this->hasOne('App\Models\User', 'id', 'usuario_id');
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
