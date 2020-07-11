<?php

namespace App;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function cart(){
        return $this->belongsTo(Cart::class);
    }
}
