<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Poa
 *
 * @property $id
 * @property $ejercicio_id
 * @property $institucion_id
 * @property $historico_id
 * @property $nacional_id
 * @property $estrategico_id
 * @property $general_id
 * @property $municipal_id
 * @property $pei_id
 * @property $unidadadministrativa_id
 * @property $proyecto
 * @property $objetivoproyecto
 * @property $montoproyecto
 * @property $responsable
 * @property $tipo
 * @property $sncfestrategico
 * @property $sncfespecifico
 * @property $psocial
 * @property $codigo
 * @property $tipoproyecto
 * @property $central
 * @property $descripcion
 * @property $created_at
 * @property $updated_at
 *
 * @property Ejecucione[] $ejecuciones
 * @property Ejercicio $ejercicio
 * @property Institucione $institucione
 * @property Meta[] $metas
 * @property Objetivogenerale $objetivogenerale
 * @property Objetivogenerale $objetivogenerale
 * @property Objetivomunicipale $objetivomunicipale
 * @property Objetivopei $objetivopei
 * @property Objetivosestrategico $objetivosestrategico
 * @property Objetivoshistorico $objetivoshistorico
 * @property Requidetbo[] $requidetbos
 * @property Requidetclaspre[] $requidetclaspres
 * @property Unidadadministrativa $unidadadministrativa
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Poa extends Model
{
    
    static $rules = [
		'ejercicio_id' => 'required',
		'institucion_id' => 'required',
		'historico_id' => 'required',
		'nacional_id' => 'required',
		'estrategico_id' => 'required',
		'general_id' => 'required',
		'municipal_id' => 'required',
		'pei_id' => 'required',
		'unidadadministrativa_id' => 'required',
		'proyecto' => 'required',
		'objetivoproyecto' => 'required',
		'montoproyecto' => 'required',
		'responsable' => 'required',
		'tipo' => 'required',
		'sncfestrategico' => 'required',
		'sncfespecifico' => 'required',
		'psocial' => 'required',
		'codigo' => 'required',
		'tipoproyecto' => 'required',
		'central' => 'required',
		'descripcion' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['ejercicio_id','institucion_id','historico_id','nacional_id','estrategico_id','general_id','municipal_id','pei_id','unidadadministrativa_id','proyecto','objetivoproyecto','montoproyecto','responsable','tipo','sncfestrategico','sncfespecifico','psocial','codigo','tipoproyecto','central','descripcion','usuario_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ejecuciones()
    {
        return $this->hasMany('App\Ejecucione', 'poa_id', 'id');
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
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function metas()
    {
        return $this->hasMany('App\Meta', 'poa_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function objetivogenerale()
    {
        return $this->hasOne('App\Objetivogenerale', 'id', 'general_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function objetivonacionale()
    {
        return $this->hasOne('App\Objetivonacionale', 'id', 'nacional_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function objetivomunicipale()
    {
        return $this->hasOne('App\Objetivomunicipale', 'id', 'municipal_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function objetivopei()
    {
        return $this->hasOne('App\Objetivopei', 'id', 'pei_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function objetivosestrategico()
    {
        return $this->hasOne('App\Objetivosestrategico', 'id', 'estrategico_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function objetivoshistorico()
    {
        return $this->hasOne('App\Objetivoshistorico', 'id', 'historico_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function requidetbos()
    {
        return $this->hasMany('App\Requidetbo', 'poa_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function requidetclaspres()
    {
        return $this->hasMany('App\Requidetclaspre', 'poa_id', 'id');
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
