<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Precompromiso
 *
 * @property $id
 * @property $documento
 * @property $montototal
 * @property $concepto
 * @property $fechaanulacion
 * @property $unidadadministrativa_id
 * @property $tipocompromiso_id
 * @property $beneficiario_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Beneficiario $beneficiario
 * @property Compromiso[] $compromisos
 * @property Detallesprecompromiso[] $detallesprecompromisos
 * @property Tipodecompromiso $tipodecompromiso
 * @property Unidadadministrativa $unidadadministrativa
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Precompromiso extends Model
{
    
    static $rules = [
		'documento' => 'required',
		'montototal' => 'required',
		'concepto' => 'required',
		'unidadadministrativa_id' => 'required',
		'tipocompromiso_id' => 'required',
		'beneficiario_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['documento','montototal','concepto','fechaanulacion','unidadadministrativa_id','tipocompromiso_id','beneficiario_id', 'status', 'created_at','usuario_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function beneficiario()
    {
        return $this->hasOne('App\Beneficiario', 'id', 'beneficiario_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function compromisos()
    {
        return $this->hasMany('App\Compromiso', 'precompromiso_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detallesprecompromisos()
    {
        return $this->hasMany('App\Detallesprecompromiso', 'precompromiso_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tipodecompromiso()
    {
        return $this->hasOne('App\Tipodecompromiso', 'id', 'tipocompromiso_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function unidadadministrativa()
    {
        return $this->hasOne('App\Unidadadministrativa', 'id', 'unidadadministrativa_id');
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

    public function scopeUnidad($query, $unidad) {
    	if ($unidad) {
    		return $query->where('unidadadministrativa_id','like',"$unidad");
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
