<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Zone extends Model
{
    protected $table = 'zone';
    public $timestamps = false;

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('orderById', function(Builder $builder) {
            $builder->orderBy('id');
        });
    }

    public function locations()
    {
        return $this->hasMany('App\Models\Location');
    }
}
