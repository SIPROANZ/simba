<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Detallesrequisicione
 *
 * @property $id
 * @property $requisicion_id
 * @property $bos_id
 * @property $cantidad
 * @property $created_at
 * @property $updated_at
 *
 * @property Bo $bo
 * @property Requisicione $requisicione
 * @property Unidadmedida $unidadmedida
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Detallesrequisicione extends Model
{
    
    static $rules = [
		'requisicion_id' => 'required',
		'bos_id' => 'required',
		'cantidad' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['requisicion_id','bos_id','cantidad'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function bo()
    {
        return $this->hasOne('App\Bo', 'id', 'bos_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function requisicione()
    {
        return $this->hasOne('App\Requisicione', 'id', 'requisicion_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function unidadmedida()
    {
        return $this->hasOne('App\Unidadmedida', 'id', 'unidadmedida_id');
    }
    

}
