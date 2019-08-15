<?php

namespace App\Http\Controllers;

use App\review;
use App\product;
use App\shoppingCart;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    //\
    public function create(Request $request, product $product){
        review::create(['review'=>$request->review,'rating'=>$request->rating,'user_id'=>auth()->user()->id,
            'product_id'=>$product->id]);

        return redirect()->back();
    }

    /**
     * not Done yet
     * @param product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function getReviewsAPI(product $product){
        $reviews = review::where('product_id',$product->id)->get();

        return response()->json($reviews,200);
    }


    public function incrementQTY(shoppingCart $cart){
        $cart->quantity++; // incrementQTY
        $cart->save();
        return response()->json(['mesage'=>'Done'],200);
    }

    public function decrementQTY(shoppingCart $cart){
        $cart->quantity--; // incrementQTY
        $cart->save();
        return response()->json(['mesage'=>'Done'],200);
    }
}
