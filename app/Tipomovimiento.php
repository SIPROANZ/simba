<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tipomovimiento
 *
 * @property $id
 * @property $descripcion
 * @property $accion
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */

class Tipomovimiento extends Model
{
    
    static $rules = [
		'descripcion' => 'required',
		'accion' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['descripcion','accion'];

      
    
}
