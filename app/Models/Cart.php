<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }

    public function supply()
    {
        return $this->belongsTo('App\Models\Supply');
    }

    public function cost(Type $var = null)
    {
        if ($this->size == "XXL") {
            return $this->amount * 86000;
        // } elseif ($this->size == "L") {
        //     # code...
        // } elseif ($this->size == "XL") {
        //     # code...
        // } elseif ($this->size == "XXL") {
        //     # code...
        } else {
            return $this->amount * 81000;
        }
    }
}
