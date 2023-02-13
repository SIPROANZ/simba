<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Requisicione
 *
 * @property $id
 * @property $concepto
 * @property $uso
 * @property $ejercicio_id
 * @property $institucion_id
 * @property $unidadadministrativa_id
 * @property $correlativo
 * @property $tiposgp_id
 * @property $estatus
 * @property $created_at
 * @property $updated_at
 *
 * @property Ejercicio $ejercicio
 * @property Institucione $institucione
 * @property Requidetbo[] $requidetbos
 * @property Requidetclaspre[] $requidetclaspres
 * @property Tipossgp $tipossgp
 * @property Unidadadministrativa $unidadadministrativa
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Requisicione extends Model
{
    
    static $rules = [
		'concepto' => 'required',
		'uso' => 'required',
		'ejercicio_id' => 'required',
		'institucion_id' => 'required',
		'unidadadministrativa_id' => 'required',
		'tiposgp_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['concepto','uso','ejercicio_id','institucion_id','unidadadministrativa_id','correlativo','tiposgp_id','estatus', 'created_at','usuario_id'];


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
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function requidetbos()
    {
        return $this->hasMany('App\Requidetbo', 'requisicion_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function requidetclaspres()
    {
        return $this->hasMany('App\Requidetclaspre', 'requisicion_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tipossgp()
    {
        return $this->hasOne('App\Tipossgp', 'id', 'tiposgp_id');
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
