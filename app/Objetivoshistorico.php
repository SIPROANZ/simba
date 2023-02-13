<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Objetivoshistorico
 *
 * @property $id
 * @property $objetivo
 * @property $created_at
 * @property $updated_at
 *
 * @property Objetivonacionale[] $objetivonacionales
 * @property Poa[] $poas
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Objetivoshistorico extends Model
{
    
    static $rules = [
		'objetivo' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['objetivo'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function objetivonacionales()
    {
        return $this->hasMany('App\Objetivonacionale', 'historico_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function poas()
    {
        return $this->hasMany('App\Poa', 'historico_id', 'id');
    }
    

}
