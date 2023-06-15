<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Unidade
 *
 * @property $id
 * @property $nombre
 * @property $representante
 * @property $gabinete_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Gabinete $gabinete
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Unidade extends Model
{
    
    static $rules = [
		'nombre' => 'required',
		'representante' => 'required',
		'gabinete_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre','representante','gabinete_id', 'usuario_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function gabinete()
    {
        return $this->hasOne('App\Gabinete', 'id', 'gabinete_id');
    }

    public function usuario()
    {
        return $this->hasOne('App\Models\User', 'id', 'usuario_id');
    }
    

}
