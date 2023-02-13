<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Compromiso
 *
 * @property $id
 * @property $unidadadministrativa_id
 * @property $tipocompromiso_id
 * @property $ncompromiso
 * @property $beneficiario_id
 * @property $montocompromiso
 * @property $status
 * @property $documento
 * @property $fechaanulacion
 * @property $precompromiso_id
 * @property $compra_id
 * @property $ayuda_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Ayudassociale $ayudassociale
 * @property Beneficiario $beneficiario
 * @property Causado[] $causados
 * @property Compra $compra
 * @property Detallescompromiso[] $detallescompromisos
 * @property Precompromiso $precompromiso
 * @property Tipodecompromiso $tipodecompromiso
 * @property Unidadadministrativa $unidadadministrativa
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Compromiso extends Model
{
    
    static $rules = [
		'unidadadministrativa_id' => 'required',
		'tipocompromiso_id' => 'required',
		'ncompromiso' => 'required',
		'beneficiario_id' => 'required',
		'montocompromiso' => 'required',
		'status' => 'required',
		'documento' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['unidadadministrativa_id','tipocompromiso_id','ncompromiso','beneficiario_id','montocompromiso','status','documento','fechaanulacion','precompromiso_id','compra_id','ayuda_id', 'created_at','usuario_id' ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ayudassociale()
    {
        return $this->hasOne('App\Ayudassociale', 'id', 'ayuda_id');
    }
    
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
    public function causados()
    {
        return $this->hasMany('App\Causado', 'compromiso_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function compra()
    {
        return $this->hasOne('App\Compra', 'id', 'compra_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detallescompromisos()
    {
        return $this->hasMany('App\Detallescompromiso', 'compromiso_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function precompromiso()
    {
        return $this->hasOne('App\Precompromiso', 'id', 'precompromiso_id');
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


}
