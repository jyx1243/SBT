<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Unit extends Model
{
    protected $table = 'unit';
    public $timestamps = false;

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('orderById', function(Builder $builder) {
            $builder->orderBy('id');
        });
    }

    public function prices()
    {
        return $this->hasMany('App\Models\Price');
    }
}
