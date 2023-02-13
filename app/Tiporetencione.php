<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tiporetencione
 *
 * @property $id
 * @property $tipo
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Tiporetencione extends Model
{

    static $rules = [
		'tipo' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['tipo'];

    public function retencione()
    {
       return $this->belongsTo('App\Retencione');
    }

}
