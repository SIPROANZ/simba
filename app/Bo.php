<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Bo
 *
 * @property $id
 * @property $descripcion
 * @property $producto_id
 * @property $unidadmedida_id
 * @property $tipobos_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Productoscp $productoscp
 * @property Productos $productos
 * @property Requidetbo[] $requidetbos
 * @property Tipobo $tipobo
 * @property Unidadmedida $unidadmedida
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Bo extends Model
{
    
    static $rules = [
		'descripcion' => 'required',
		'producto_id' => 'required',
		'unidadmedida_id' => 'required',
		'tipobos_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['descripcion','producto_id','unidadmedida_id','tipobos_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function productoscp()
    {
        return $this->hasOne('App\Productoscp', 'id', 'producto_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function productos()
    {
        return $this->hasOne('App\Producto', 'id', 'producto_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function requidetbos()
    {
        return $this->hasMany('App\Requidetbo', 'bos_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tipobo()
    {
        return $this->hasOne('App\Tipobo', 'id', 'tipobos_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function unidadmedida()
    {
        return $this->hasOne('App\Unidadmedida', 'id', 'unidadmedida_id');
    }
    

}
