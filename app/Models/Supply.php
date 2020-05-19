<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supply extends Model
{
    public function sender()
    {
        return $this->belongsTo('App\Models\Sender');
    }

    public function receiver()
    {
        return $this->belongsTo('App\Models\Receiver');
    }

    public function carts()
    {
        return $this->hasMany('App\Models\Cart');
    }

    public function countProduct()
    {
        $carts = $this->carts;

        $count = 0;
        foreach ($carts as $cart) {
            $count += $cart->amount;
        }

        return $count;
    }
}
