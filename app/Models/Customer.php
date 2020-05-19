<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    public function village()
    {
        return $this->belongsTo('App\Models\Village');
    }

    
}
