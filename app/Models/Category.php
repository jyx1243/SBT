<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Category extends Model
{
    protected $table = 'category';
    public $timestamps = false;

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('orderById', function(Builder $builder) {
            $builder->orderBy('id');
        });
    }

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }

    public function options()
    {
        return $this->hasManyThrough('App\Models\Option', 'App\Models\Product');
    }
}
