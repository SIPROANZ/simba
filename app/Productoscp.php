<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Productoscp
 *
 * @property $id
 * @property $producto_id
 * @property $clasificadorp_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Bo[] $bos
 * @property Clasificadorpresupuestario $clasificadorpresupuestario
 * @property Producto $producto
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Productoscp extends Model
{
    
    static $rules = [
		'producto_id' => 'required',
		'clasificadorp_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['producto_id','clasificadorp_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bos()
    {
        return $this->hasMany('App\Bo', 'producto_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function clasificadorpresupuestario()
    {
        return $this->hasOne('App\Clasificadorpresupuestario', 'id', 'clasificadorp_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function producto()
    {
        return $this->hasOne('App\Producto', 'id', 'producto_id');
    }
    

}
