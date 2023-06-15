<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Gabinete
 *
 * @property $id
 * @property $nombre
 * @property $representante
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Gabinete extends Model
{
    
    static $rules = [
		'nombre' => 'required',
		'representante' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre','representante', 'usuario_id'];

    public function usuario()
    {
        return $this->hasOne('App\Models\User', 'id', 'usuario_id');
    }


}
