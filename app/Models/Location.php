<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'location';
    protected $with = ['zone'];

    public function zone()
    {
        return $this->belongsTo('App\Models\Zone');
    }

    public function Option()
    {
        return $this->belongsTo('App\Models\Option');
    }
}
