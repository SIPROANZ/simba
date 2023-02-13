<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Banco
 *
 * @property $id
 * @property $denominacion
 * @property $created_at
 * @property $updated_at
 *
 * @property Cuentasbancaria[] $cuentasbancarias
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Banco extends Model
{
    
    static $rules = [
		'denominacion' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['denominacion'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cuentasbancarias()
    {
        return $this->hasMany('App\Cuentasbancaria', 'banco_id', 'id');
    }
    

}
