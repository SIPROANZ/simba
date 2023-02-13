<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Objetivopei
 *
 * @property $id
 * @property $objetivopei
 * @property $objetivo
 * @property $municipal_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Objetivomunicipale $objetivomunicipale
 * @property Poa[] $poas
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Objetivopei extends Model
{
    
    static $rules = [
		'objetivopei' => 'required',
		'objetivo' => 'required',
		'municipal_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['objetivopei','objetivo','municipal_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function objetivomunicipale()
    {
        return $this->hasOne('App\Objetivomunicipale', 'id', 'municipal_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function poas()
    {
        return $this->hasMany('App\Poa', 'pei_id', 'id');
    }
    

}
