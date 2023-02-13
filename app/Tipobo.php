<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tipobo
 *
 * @property $id
 * @property $nombre
 * @property $created_at
 * @property $updated_at
 *
 * @property Bo[] $bos
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Tipobo extends Model
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
    protected $fillable = ['nombre'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bos()
    {
        return $this->hasMany('App\Bo', 'tipobos_id', 'id');
    }
    

}
