<?php

namespace App\Http\Controllers;

use App\order;
use App\shoppingCart;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function makeOrder(Request $request){
        $this->validate($request,[
            'lastName'  => 'required',
            'city'      => 'required',
            'area'      => 'required',
            'street'    => 'required',
            'locationType'=> 'required',
            'phone'     => 'required|regex:/(01)[0-9]{9}/'
        ]);
        //dd($request->all());
        $carts =shoppingCart::where([
            'user_id' => auth()->user()->id,
            'ordered' => -1,
        ])->get();
        $total = 0;
        foreach ($carts as $cart){
            if( $cart->product->discounted_price == 0)
                $total += $cart->product->price * $cart->quantity;
            else
                $total += $cart->product->discounted_price * $cart->quantity;
        }
        $order = order::create([
            'total_amount' => $total,
            'user_id' => auth()->user()->id,
            'shopping_id' => time(),
        ]);

        foreach ($carts as $cart){
            $cart->order_id = $order->id;
            $cart->ordered = 0;
            $cart->save();
        }
        return redirect(route('home'));
    }
}
