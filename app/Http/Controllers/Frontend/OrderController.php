<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;

class OrderController extends Controller
{
     function checkout(){
      $carts = Cart::where('customer_id', auth('customer')->id())->with('product')->get();
      
        return view('frontend.checkout' , compact('carts'));
     }
}
