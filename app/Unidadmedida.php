<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Unidadmedida
 *
 * @property $id
 * @property $nombre
 * @property $created_at
 * @property $updated_at
 *
 * @property Bo[] $bos
 * @property Requidetbo[] $requidetbos
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Unidadmedida extends Model
{
    
    static $rules = [
		'nombre' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre','usuario_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bos()
    {
        return $this->hasMany('App\Bo', 'unidadmedida_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function requidetbos()
    {
        return $this->hasMany('App\Requidetbo', 'undmedida_id', 'id');
    }
    public function usuario()
    {
        return $this->hasOne('App\Models\User', 'id', 'usuario_id');
    }  

}
