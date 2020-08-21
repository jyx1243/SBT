<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table = 'sale';

    public function price()
    {
        return $this->belongsTo('App\Models\Price');
    }
}
