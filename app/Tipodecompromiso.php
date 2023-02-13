<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tipodecompromiso
 *
 * @property $id
 * @property $nombre
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Tipodecompromiso extends Model
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

    public function usuario()
    {
        return $this->hasOne('App\Models\User', 'id', 'usuario_id');
    }

}
