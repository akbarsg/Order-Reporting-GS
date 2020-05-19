<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function carts()
    {
        return $this->hasMany('App\Models\Cart');
    }

    public function delivery()
    {
        return $this->belongsTo('App\Models\Delivery');
    }

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }

    public function store()
    {
        return $this->belongsTo('App\Models\Store');
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

    public function serviceCost()
    {
        $carts = $this->carts;

        $cost = 0;
        foreach ($carts as $cart) {
            $cost += 4000 * $cart->amount;
        }

        return $cost;
    }

    public function mainBill()
    {
        $carts = $this->carts;

        $cost = 0;
        foreach ($carts as $cart) {
            $cost += $cart->cost;
        }

        return $cost;
    }
}
