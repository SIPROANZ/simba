<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tipomodificacione
 *
 * @property $id
 * @property $nombre
 * @property $created_at
 * @property $updated_at
 *
 * @property Modificacione[] $modificaciones
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Tipomodificacione extends Model
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
    public function modificaciones()
    {
        return $this->hasMany('App\Modificacione', 'tipomodificacion_id', 'id');
    }
    

}
