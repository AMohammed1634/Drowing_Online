<?php

namespace App\Http\Controllers;

use App\review;
use App\product;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    //\
    public function create(Request $request, product $product){
        review::create(['review'=>$request->review,'rating'=>$request->rating,'user_id'=>auth()->user()->id,
            'product_id'=>$product->id]);

        return redirect()->back();
    }
    public function getReviewsAPI(product $product){
        $reviews = review::where('product_id',$product->id)->get();

        return response()->json($reviews,200);
    }
}
