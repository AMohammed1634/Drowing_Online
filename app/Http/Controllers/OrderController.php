<?php

namespace App\Http\Controllers;

use App\order;
use App\shoppingCart;
use App\UserInfo;
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

            'phone'     => 'required|regex:/(01)[0-9]{9}/'
        ]);

        UserInfo::create([
            'user_id'   => auth()->user()->id,
            'last_name' => $request->lastName,
            'area'      => $request->area,
            'street_name' => $request->street,
            'phone'     => $request->phone,
            //'city '     => $request->city,
            'city' => $request->city

        ]);
        //dd($request->all());
        $carts =shoppingCart::where([
            'user_id' => auth()->user()->id,
            'ordered' => -1,
        ])->get();
        $total = 0;
        if(count($carts) <1){
            return redirect()->back()->withErrors(['message' => 'No products to orderring ']);
        }
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
