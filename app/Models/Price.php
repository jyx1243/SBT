<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $table = 'price';

    public function option()
    {
        return $this->belongsTo('App\Models\Option');
    }

    public function unit()
    {
        return $this->belongsTo('App\Models\Unit');
    }

    public function sale()
    {
        return $this->hasMany('App\Models\Sale');
    }
}
