<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller{

    public function view(){
        Cart::add('192ao12', 'Product 1', 1, 9.99);
        Cart::add('1239ad0', 'Product 2', 2, 5.95, ['size' => 'large']);

        //Cart::store('username');

        $items = Cart::content();
        $subtotal = Cart::subtotal();
        $total = Cart::total();

        return view('cart.view', compact('items', 'subtotal', 'total'));
    }
}