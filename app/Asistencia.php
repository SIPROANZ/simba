<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Asistencia
 *
 * @property $id
 * @property $cedula
 * @property $evento_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Evento $evento
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Asistencia extends Model
{
    
    static $rules = [
		'cedula' => 'required',
		'evento_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['cedula','evento_id', 'usuario_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function evento()
    {
        return $this->hasOne('App\Evento', 'id', 'evento_id');
    }

    public function usuario()
    {
        return $this->hasOne('App\Models\User', 'id', 'usuario_id');
    }
    

}
