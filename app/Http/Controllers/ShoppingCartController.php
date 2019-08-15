<?php

namespace App\Http\Controllers;

use App\product;
use App\shoppingCart;
use Illuminate\Http\Request;

class ShoppingCartController extends Controller
{
    //
    public function addToCart(product $product){
        $last = shoppingCart::where(['product_id'=>$product->id,'user_id'=>auth()->user()->id])->count();
        if($last>0){
            return redirect()->back()->withErrors(['message'=>'You Added This Product Last Time']);
        }
        shoppingCart::create([
            'quantity'=> 1,
            'product_id'=>$product->id,
            'user_id'=>auth()->user()->id,
            ]);
        return redirect()->back();
    }
    public function shopping_cart(){
        $carts = shoppingCart::where(['user_id'=>auth()->user()->id , 'ordered'=>-1])->get();
        return view('user.shopping_cart',compact('carts'));
    }
    public function destroy(shoppingCart $cart){
        $cart->delete();
        return redirect()->back();

    }
    public function checkout(){
        $carts = shoppingCart::where(['user_id'=>auth()->user()->id , 'ordered'=>-1])->get();
        return view('user.checkout',compact('carts'));
    }
}
