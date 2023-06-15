<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Evento
 *
 * @property $id
 * @property $nombre
 * @property $tipo
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Evento extends Model
{
    
    static $rules = [
		'nombre' => 'required',
		'tipo' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre','tipo', 'usuario_id'];


    public function usuario()
    {
        return $this->hasOne('App\Models\User', 'id', 'usuario_id');
    }

}
